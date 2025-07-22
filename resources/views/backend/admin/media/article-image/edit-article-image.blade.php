@extends('backend/layouts/admin/template')
<style>
    .media h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .media h3 {
        color: #a7a7a7e1;
    }

    .media p {
        font-size: 16px;
    }

    .media span {
        font-size: 14px;
        color: red;
        font-weight: 500;
    }

    .media a {
        color: #ffffff;
    }

    .media a:hover {
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
        <div class="media">
            <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
                </div>
            </div>
            <h4 class="mt-4">Update Image</h4>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if (Session::has('alert-' . $msg))
                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        </p>
                    @endif
                @endforeach
            </div>
            <form action="{{ url('update-article-image') }}" enctype="multipart/form-data" method="post">@csrf
                <div class="row">
                    <div class="col-lg-3 col-12 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <div class="row">
                                    @if ($errors->has('image'))
                                        <center><span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('image') }})</span>
                                        </center>
                                    @endif
                                    <input type="file" id="file" name="image" accept="image/*" hidden>
                                    <div class="img-area" data-img="">
                                        <i class="fa fa-cloud-upload icon" aria-hidden="true"></i>
                                        <h5>Update Image</h5>
                                    </div>
                                    <a class="select-image mb-4" style="text-align: center;">SELECT IMAGE</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <input type="hidden" name="id" value="{{ $article_image->id }}">
                                        <center><button type="submit" class="btn btn-lg btn-success">Update Image</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
