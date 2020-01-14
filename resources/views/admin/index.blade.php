@extends("layouts.admin.main")
@section("content")

    @include('layouts.admin.nav')
    <main class="pt-3 ">
        <div class="container-fluid p-0">
            <!-- Breadcrumb -->
            <div class="row mx-0  divider-border">
                <div class="col-md-12">
                    <div class="breadcrumb-wrap padding">
                        <div class="d-flex align-items-end">
                            <span class="mr-1 breadcrumb-icon m-0 p-0"><i class="fas fa-suitcase"></i></span>
                            <span class="mx-1 breadcrumb-arrow"><i class="fas fa-angle-right"></i></span>
                            <span class="mx-1 breadcrumb-text">Onderdelen</span>
                            <span class="mx-1 breadcrumb-arrow"><i class="fas fa-angle-right"></i></span>
                            <span class="mx-1 breadcrumb-text font-weight-bold">Inkomstenstromen</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb -->

            <!-- Uploader section -->
            <div class="col-md-4 my-lg-0 my-md-0 my-2">
                <div class="assigment-wrap padding">
                    <!-- Header text uploader section -->
                    <div class="assigment-header">
                        Inleverpunt
                    </div>
                    <!-- Header text uploader section -->
                    <!-- Uploader section form -->
                    <div class="full-flex assigment-uploader flex-column mt-3 box-shadow-light bg-white">
                        <div class="uploader-header d-flex align-items-center">Bestand uploaden</div>
                        <div class="uploader-content full-flex flex-column py-4">
                            <!-- Uploader current status -->
                            <div class="upload-status full-flex">
                                <span class="upload-icon"><i class="fas fa-eye"></i></span>
                                <div class="d-flex flex-column ml-3 w-100">
                                    <span class="upload-text">Nakijkstatus</span>
                                    <small class="upload-text-small">In behandeling</small>
                                    <div class="upload-bar"></div>
                                </div>
                            </div>
                            <!-- Uploader current status -->
                            <!-- Uploader rating status -->
                            <div class="upload-status full-flex mt-3">
                                <span class="upload-icon"><i class="fas fa-star"></i></span>
                                <div class="d-flex flex-column ml-3 w-100">
                                    <span class="upload-text">Beoordeling</span>
                                    <small class="upload-text-small">met een goed beoordeeld</small>
                                    <div class="upload-bar" style="background: #44e15f;"></div>
                                </div>
                            </div>
                            <!-- Uploader rating status -->
                        </div>
                        <!-- Uploader clickable -->
                        <div class="uploader mt-1">
                            <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend w-100 file-wrap">
                                        <input class="input-file" id="my-file" type="file" name="image"/>
                                        <input class="w-100" id="my-filename" type="text"
                                               placeholder="voorbeeld-S1121670.pdf"/>
                                        <label class="upload-btn waves-effect"
                                               tabindex="0" for="my-file"
                                               style="background-image: url({{ asset('img/dashboard/purple-blue.png') }});
                                                       background-repeat: no-repeat; background-size: 100% 100%;">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                </div>
                            </form>
                        </div>
                        <!-- Uploader clickable -->
                    </div>
                    <!-- Uploader section form -->
                </div>
            </div>
            <!-- Uploader section -->
        </div>
        <!-- Easyinfo -->
        </div>

    </main>
@endsection
