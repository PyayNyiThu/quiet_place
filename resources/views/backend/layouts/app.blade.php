<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quiet Place Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/img/bg-img/meeting-room.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('backend.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('backend.layouts.header')

                <!-- Begin Page Content -->
                @yield('content')
                <!-- End of Main Content -->

                <!-- Footer -->
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span style="color: black;">Copyright &copy; 2021. All right reserved | by Team Astro</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script> --}}

    {{-- <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script> --}}

    <script src="{{ asset('backend/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('backend/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script> --}}
    

    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- One Signal -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

    <script type="text/javascript">
        let token = document.head.querySelector("meta[name='csrf-token']");

        if (token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF_TOKEN': token.content,
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                }
            })
        }

        $(".back-btn").on("click", function() {
            window.history.go(-1);
            return false;
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".newImage").change(function() {
            readURL(this);
        });

        // $('.summernote').summernote({
        //     placeholder: 'Description',
        //     tabsize: 2,
        //     height: 100
        // });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session('create'))
            Toast.fire({
            icon: 'success',
            title: "{{__('messages.session_create')}}"
            })
        @endif

        @if (session('update'))
            Toast.fire({
            icon: 'success',
            title: "{{__('messages.session_update')}}"
            })
        @endif

        @if (session('delete'))
            Toast.fire({
            icon: 'success',
            title: "{{__('messages.session_delete')}}"
            })
        @endif

        @if (session('restore'))
            Toast.fire({
            icon: 'success',
            title: "{{__('messages.session_restore')}}"
            })
        @endif

        @if (session('not_allow'))
            Toast.fire({
            icon: 'error',
            title: "{{__('messages.session_not_allow')}}"
            })
        @endif

        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "f5340657-eaf5-46ee-bb6e-05ab628520d9",
            });

            OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                if (isEnabled) {
                    OneSignal.getUserId(function(userId) {
                        console.log("Player id of subscribed user is : " + userId);
                    });
                }
            });

            OneSignal.setSubscription(true);
        });
        window.localStorage.clear();
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script> --}}

    @yield('script')
</body>

</html>
