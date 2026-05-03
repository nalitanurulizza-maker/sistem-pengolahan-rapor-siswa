@section('title', 'e-Rapor | Sistem Manajemen Rapor Digital')

@section('content')

@include('partials.navbar')
@include('partials.hero')
@include('partials.about')
@include('partials.contact')
@include('partials.footer')
@include('partials.modal')

@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection