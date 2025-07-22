@extends('backend/layouts/admin/template')
<style>
    .account p {
        font-weight: bolder;
    }

    .account span {
        color: rgba(253, 48, 48, 0.699);
        font-size: 14px;
    }

    .account a {
        color: #ffffff;
    }

    .account a:hover {
        color: #ffffff;
    }

    .img-area {
        position: relative;
        width: 100%;
        height: 240px;
        background: #e4e4e4;
        margin-bottom: 20px;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

    }

    .img-area .icon {
        font-size: 50px;
    }

    .img-area img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 100;
    }

    .img-area::before {
        content: attr(data-img);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .5);
        color: #fff;
        font-weight: 500;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: none;
        opacity: 0;
        transition: all .3s easeว
    }

    .img-area.active:hover::before {
        opacity: 1;
    }

    .select-image {
        display: block;
        width: 100%;
        padding: 12px 0;
        border-radius: 15px;
        background: #1229f5;
        color: #fff;
        font-weight: 500;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: all .3s ease;
        z-index: 200;
    }

    .select-image:hover {
        background: #3939eb;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <form action="{{ url('/update-account-store') }}" enctype="multipart/form-data" method="post">@csrf
            <div class="row mt-4">
                <div class="col-lg-3 col-12 mb-lg-0 mb-4">
                    <div class="account card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            @if ($errors->has('image'))
                                <center><span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('image') }})</span></center>
                            @endif
                            <input type="file" id="file" name="image" accept="image/*" hidden>
                            <div class="img-area" data-img="">
                                <i class="fa fa-cloud-upload icon" aria-hidden="true"></i>
                                <h5>Upload Logo</h5>
                            </div>
                            <a class="select-image mb-4" style="text-align: center;">SELECT LOGO</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                    <p class="alertdesign alert alert-{{ $msg }}">
                                        {{ Session::get('alert-' . $msg) }}
                                    </p>
                                @endif
                            @endforeach
                        </div>
                        <div class="card-header pb-0 pt-5 bg-transparent center" style="font-size: 28px;">
                            แก้ไขข้อมูลร้านค้า
                        </div>

                        <div class="card-body">
                            <div class="account">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><span>*</span> ชื่อร้านค้า <span>(จำเป็นต้องกรอก)</span></p>
                                        <input class="form-control" type="text" value="{{ $account_store->store_name }}"
                                            name="store_name">
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="mt-2"><span>*</span><span> (จำเป็นต้องกรอก)</span></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-9 mt-2">
                                        <p><span>*</span> สาขา <span></span></p>
                                        <input class="form-control" type="text" value="{{ $account_store->branch }}"
                                            name="branch">
                                    </div>
                                    <div class="col-md-5 col-9 mt-2">
                                        <p><span>*</span> เบอร์โทรศัพท์ <span></span></p>
                                        <input class="phone_format form-control" type="text"
                                            value="{{ $account_store->tel }}" name="tel">
                                    </div>
                                    <div class="col-md-5 col-9 mt-2">
                                        <p><span>*</span> ชื่อเข้าใช้งาน <span></span></p>
                                        <input class="form-control" type="text" value="{{ $account_store->username }}"
                                            name="username" readonly>
                                    </div>
                                    <div class="col-md-5 col-9 mt-2">
                                        <p><span>*</span> รหัสผ่าน <span></span></p>
                                        <input class="form-control" type="text" value="{{ $account_store->password_name }}"
                                            name="password_name">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <p>สถานะ</p>
                                        <select name="status" class="form-control">
                                            <option value="{{$account_store->status}}">{{$account_store->status}}</option>
                                            <option value="เปิด">เปิด</option>
                                            <option value="ปิด">ปิด</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <input type="hidden" name="id" value="{{$account_store->id}}">
                                        <button type="submit" class="btn btn-lg btn-success">อัพเดตข้อมูลร้านค้า</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>

    <script type="text/javascript" src="{{ asset('https://code.jquery.com/jquery-3.2.1.min.js') }}"></script>
    <script>
        const selectImage = document.querySelector('.select-image');
        const inputFile = document.querySelector('#file');
        const imgArea = document.querySelector('.img-area');

        selectImage.addEventListener('click', function() {
            inputFile.click('');
        });

        inputFile.addEventListener('change', function() {
            const image = this.files[0]
            console.log(image);
            if (image.size < 2000000) {
                const reader = new FileReader();
                reader.onload = () => {
                    const allImg = imgArea.querySelectorAll('img');
                    allImg.forEach(item => item.remove());
                    const imgUrl = reader.result;
                    const img = document.createElement('img');
                    img.src = imgUrl;
                    imgArea.appendChild(img);
                    imgArea.classList.add('active');
                    imgArea.dataset.img = image.name;
                }
                reader.readAsDataURL(image);
            } else {
                alert('Image size more than 2MB');
            }

        });
    </script>
@endsection
