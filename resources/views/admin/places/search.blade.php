@extends('admin.places.layout')
@section('title','Cari via Foursquare')
@section('content')
<form method="GET" class="mb-6">
  <div class="flex gap-2">
    <input name="q" value="{{ $query ?? '' }}" placeholder="mau cari apa? contoh: bakso" class="w-full px-3 py-2 border rounded" />
    <input name="near" placeholder="near (kota)" value="{{ request('near','Jakarta') }}" class="px-3 py-2 border rounded w-56" />
    <button class="px-3 py-2 bg-blue-600 text-white rounded">Cari</button>
  </div>
</form>

@if(!empty($results['results']))
  <div class="grid grid-cols-2 gap-4">
    @foreach($results['results'] as $r)
      <div class="p-4 bg-white rounded shadow">
        <h3 class="font-semibold">{{ $r['name'] }}</h3>
        <p class="text-sm text-gray-600">{{ $r['location']['formatted_address'] ?? '' }}</p>
        <div class="mt-3 flex gap-2">
          <a href="{{ route('admin.places.import', $r['fsq_id']) }}" class="px-3 py-1 bg-green-600 text-white rounded">Import</a>
          <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($r['location']['formatted_address'] ?? $r['name']) }}" target="_blank" class="px-3 py-1 bg-gray-200 rounded">Map</a>
        </div>
      </div>
    @endforeach
  </div>
@elseif(isset($query))
  <div class="p-4 bg-yellow-50 text-yellow-800">Tidak ada hasil untuk "{{ $query }}"</div>
@endif
@endsection
