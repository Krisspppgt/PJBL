<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Services\FoursquareService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;

class PlaceController extends Controller
{
    protected $fs;

        public function __construct()
        {
            $this->middleware('auth');
        }

    // List
    public function index(Request $request)
    {
        $query = Place::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        $places = $query->latest()->paginate(12)->withQueryString();
        return view('admin.places.index', compact('places'));
    }

    // Show form to search API
    public function search(Request $request)
    {
        $results = null;
        $query = $request->query('q');
        if ($query) {
            $results = $this->fs->search($query, $request->query('near', 'Semarang'), 12);
        }
        return view('admin.places.search', compact('results','query'));
    }

    // Import: show create form prefilled with API detail
    public function import($fsq_id)
    {
        $detail = $this->fs->details($fsq_id);
        $photos = $this->fs->photos($fsq_id);
        $photoUrl = $this->fs->firstPhotoUrl($photos);

        // map fields to our form/data
        $data = [
            'name' => $detail['name'] ?? null,
            'address' => data_get($detail, 'location.formatted_address'),
            'rating' => data_get($detail, 'rating', 0),
            'reviews_count' => data_get($detail, 'stats.total_ratings', 0),
            'phone' => data_get($detail, 'tel'),
            'opening_hours' => json_encode($this->fs->parseOpeningHours($detail)),
            'image_url' => $photoUrl,
           
            // Default values untuk field baru
            'instagram' => null,
            'district' => null,
        ];

        return view('admin.places.create', compact('data'));
    }

    // show create
    public function create()
    {
        return view('admin.places.create', ['data' => []]);
    }

    // store - saves into DB and handles image (upload remote image OR uploaded file)
    public function store(Request $request)
    {
        $v = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:cafe,restaurant,street-food,bakery,drink-area,catering',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'district' => 'required|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'image' => 'nullable|image',
            'image_url' => 'nullable|url',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'phone' => 'nullable|string|max:20',
            'opening_hours' => 'nullable|string',
            'foursquare_id' => 'nullable|string'
        ]);

        // handle image: priority file upload > image_url (download)
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
        } elseif ($request->filled('image_url')) {
            // download remote image to public/images
            try {
                $contents = @file_get_contents($request->image_url);
                if ($contents) {
                    $ext = pathinfo(parse_url($request->image_url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                    $imageName = time() . '-' . Str::random(6) . '.' . $ext;
                    file_put_contents(public_path("images/{$imageName}"), $contents);
                }
            } catch (\Exception $e) {
                // silent fail
            }
        }

        $place = Place::create([
            'user_id' => Auth::id(),
            'name' => $v['name'],
            'category' => $v['category'],
            'description' => $v['description'] ?? null,
            'address' => $v['address'] ?? null,
            'district' => $v['district'],
            'instagram' => $v['instagram'] ?? null,
            'image' => $imageName,
            'rating' => $v['rating'] ?? 0,
            'reviews_count' => $v['reviews_count'] ?? 0,
            'tags' => $request->tags ?? null,
            'phone' => $v['phone'] ?? null,
            'opening_hours' => $v['opening_hours'] ?? null,
            'price_range' => $request->price_range ?? null,
           
        ]);

        return redirect()->route('admin.places.index')->with('success', 'Tempat berhasil disimpan.');
    }

    // edit form
    public function edit(Place $place)
    {
        return view('admin.places.edit', [
            'place' => $place,
            'categories' => Category::all(),
        ]);
    }

    // update
    public function update(Request $request, Place $place)
    {
        $v = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:cafe,restaurant,street-food,bakery,drink-area,catering',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'district' => 'required|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'opening_hours' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            // delete old
            if ($place->image && file_exists(public_path("images/{$place->image}"))) {
                @unlink(public_path("images/{$place->image}"));
            }
            $file = $request->file('image');
            $imageName = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $v['image'] = $imageName;
        }

        $place->update($v);

        return redirect()->route('admin.places.index')->with('success', 'Tempat diperbarui.');
    }

    // destroy
    public function destroy(Place $place)
    {
        if ($place->image && file_exists(public_path("images/{$place->image}"))) {
            @unlink(public_path("images/{$place->image}"));
        }
        $place->delete();
        return redirect()->route('admin.places.index')->with('success', 'Tempat dihapus.');
    }
}