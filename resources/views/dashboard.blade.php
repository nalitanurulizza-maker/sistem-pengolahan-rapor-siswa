@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<style>
.welcome {
  background:linear-gradient(45deg,#4facfe,#00f2fe);
  color:white;
  padding:20px;
  border-radius:12px;
  margin-bottom:20px;
}
  color:white;
  padding:20px;
  border-radius:10px;
  margin-bottom:20px;
}

.cards {
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
  gap:15px;
}
.card {
  padding:20px;
  border-radius:12px;
  color:white;
  font-weight:bold;
  display:flex;
  justify-content:space-between;
  align-items:center;
}
.card i { font-size:24px; }

.card:nth-child(1){background:linear-gradient(45deg,#7b2ff7,#9b59b6);} 
.card:nth-child(2){background:linear-gradient(45deg,#00c6ff,#0072ff);} 
.card:nth-child(3){background:linear-gradient(45deg,#ff512f,#dd2476);} 
.card:nth-child(4){background:linear-gradient(45deg,#36d1dc,#5b86e5);} 
.card:nth-child(5){background:linear-gradient(45deg,#f7971e,#ffd200);} 
.card:nth-child(6){background:linear-gradient(45deg,#c31432,#240b36);} 
</style>

<div class="content">

    <div class="welcome">
        <h3>Selamat Datang di Halaman Admin</h3>
        <p>Anda login sebagai Admin</p>
    </div>

    <div class="cards">
        <div class="card">
            Pengguna {{ $data['pengguna'] }}
            <i class="fa fa-users"></i>
        </div>

        <div class="card">
            Guru {{ $data['guru'] }}
            <i class="fa fa-user-tie"></i>
        </div>

        <div class="card">
            Siswa {{ $data['siswa'] }}
            <i class="fa fa-user-graduate"></i>
        </div>

        <div class="card">
            Mapel {{ $data['mapel'] }}
            <i class="fa fa-book"></i>
        </div>
    </div>

</div>

@endsection