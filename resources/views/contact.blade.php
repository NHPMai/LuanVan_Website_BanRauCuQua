<!DOCTYPE html>
<html lang="en">

<head>
    @include('head')
</head>

<body>
    @include('header')


    <!-- Cart -->
    @include('cart')

    <div>
        <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg" style="background-image: url(&quot;/template/images/rauqua2.jpg&quot;);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <p style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif ;color:brown ;font-size:50px;font-weight:600; font-style:italic; margin-top:0px"> Liên Hệ </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="app__container  pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15729855.42909206!2d96.7382165931671!3d15.735434000981483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31157a4d736a1e5f%3A0xb03bb0c9e2fe62be!2zVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1445179448264" width="100%" height="100%" frameborder="0" style="border:0" scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>
                            <br />
                        </a>

                    </div>

                    <div class="col-md-6 mobile-m">
                        <h2 class="text-center mb-4 mt-2">Kết nối với chúng tôi</h2>
                        <form name="regfr" method="POST" onsubmit="return frmValidate()" id="signupForm">
                            <div class="form-group">
                                <input type="text" id="name" name="hoten" class="form-control " style="height:47px" placeholder="Họ và tên" required title="Họ tên không được rỗng!">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control " style="height:47px" required placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Phải nhập eamil đúng định dạng!">
                            </div>
                            <div class="form-group">
                                <textarea type="text" id="validate" name="nd" cols="30" rows="7" class="form-control  mt-2" required placeholder="Nội dung" title="Nội dung không được rỗng!"></textarea>
                            </div>
                            <div class="d-flex">
                                <div class="form-group me-3 mr-1">
                                    <input type="submit" value="Gửi" class="btn btn-primary py-3 px-5 ">
                                </div>
                                <div class="form-group">
                                    <input type="reset" value="Hủy" class="btn btn-primary py-3 px-5 ">
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <div class="container pb-5">
                <div class="row d-flex">
                    <div class="col-md-12 my-3">
                        <h4 class=" fw-bold">Thông tin kết nối</h4>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <span>Địa chỉ:</span>
                            9/7 Mậu Thân, Xuân Khánh, Ninh Kiều, Cần Thơ
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <span>Số điện thoại:</span>
                            <a href="#" style="color: #c8a97e">+8434 3452 99</a>
                        </p>
                    </div>

                    <div class="col-md-4">
                        <p class="">
                            <span>Email:</span>
                            <a href="#" class="" style="color: #c8a97e;">MaiStoren@gmail.com</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

	@include('footer')
</body>
</html>