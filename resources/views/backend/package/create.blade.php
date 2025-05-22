@extends('layouts.backend.main')

@section('title', 'Tambah Paket')

@section('content')
<div class="db-info-wrap db-add-tour-wrap">
    <div class="row">
        <!-- Listings -->
        <div class="col-lg-12">
            <form action="{{ route('packages.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
                <div class="dashboard-box">
                    <div class="custom-field-wrap">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Maskapai</label>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview" width="100px">
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="file" class="form-control @error('airline') is-invalid @enderror" name="airline" id="airline"  accept="image/*" onchange="previewImg()">
                                            @error('airline')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Nama Paket</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama Paket" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Maksimal Penumpang</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('passenger') is-invalid @enderror" name="passenger" placeholder="Maksimal Penumpang" value="{{ old('passenger') }}">
                                    @error('passenger')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Tanggal</label>
                                <div class="form-group">
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="Tanggal" value="{{ old('date') }}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Hari</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('day') is-invalid @enderror" name="day" placeholder="Hari" value="{{ old('day') }}">
                                    <small>Contoh: 9 Hari</small>
                                    @error('day')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Harga</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Harga" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-box">
                    <h4>Hotel 1</h4>
                    <div class="custom-field-wrap">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Bintang</label>
                                    <div class="start star-hotel-1">
                                        <i class="fa fa-star" onclick="hotel1(1)"></i>
                                        <i class="fa fa-star" onclick="hotel1(2)"></i>
                                        <i class="fa fa-star" onclick="hotel1(3)"></i>
                                        <i class="fa fa-star" onclick="hotel1(4)"></i>
                                        <i class="fa fa-star" onclick="hotel1(5)"></i>
                                    </div>
                                    
                                    <input type="hidden" class="form-control @error('star_1') is-invalid @enderror" name="star_1" id="hotel1" value="{{ old('star_1') }}">
                                    @error('star_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Nama Hotel</label>
                                    <input type="text" class="form-control @error('name_1') is-invalid @enderror" name="name_1" placeholder="Nama Hotel" value="{{ old('name_1') }}">
                                    @error('name_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control @error('city_1') is-invalid @enderror" name="city_1" placeholder="Kota" value="{{ old('city_1') }}">
                                    @error('city_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Hotel 2</h4>
                    <div class="custom-field-wrap">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Bintang</label>
                                    <div class="start star-hotel-2">
                                        <i class="fa fa-star" onclick="hotel2(1)"></i>
                                        <i class="fa fa-star" onclick="hotel2(2)"></i>
                                        <i class="fa fa-star" onclick="hotel2(3)"></i>
                                        <i class="fa fa-star" onclick="hotel2(4)"></i>
                                        <i class="fa fa-star" onclick="hotel2(5)"></i>
                                    </div>
                                    <input type="hidden" class="form-control @error('star_2') is-invalid @enderror" name="star_2" id="hotel2" value="{{ old('star_2') }}">
                                    @error('star_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Nama Hotel</label>
                                    <input type="text" class="form-control @error('name_2') is-invalid @enderror" name="name_2" placeholder="Nama Hotel" value="{{ old('name_2') }}">
                                    @error('name_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control @error('city_2') is-invalid @enderror" name="city_2" placeholder="Kota" value="{{ old('city_2') }}">
                                    @error('city_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn button-primary text-dark w-100">Simpan</button>
            </form>
        </div>
    </div>      
</div>
@endsection

@section('js')
<script src="{{ asset('backend') }}/assets/plugins/autoNumeric/autoNumeric.min.js"></script>
<script>
    new AutoNumeric('#price', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    function previewImg() {
        const airline = document.querySelector('#airline');
        const imgPreview = document.querySelector('.img-preview');
        const fileImg = new FileReader();
        fileImg.readAsDataURL(airline.files[0]);
        fileImg.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function hotel1(starCount) {
        const stars = document.querySelectorAll('.star-hotel-1 i');
        stars.forEach((star, index) => {
            if (index < starCount) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
        // Set the hidden input value
        document.getElementById('hotel1').value = starCount;
    }

    function hotel2(starCount) {
        const stars = document.querySelectorAll('.star-hotel-2 i');
        stars.forEach((star, index) => {
            if (index < starCount) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
        // Set the hidden input value
        document.getElementById('hotel2').value = starCount;
    }
</script>
@endsection