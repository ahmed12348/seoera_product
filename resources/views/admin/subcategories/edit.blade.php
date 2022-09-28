@extends('layouts.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.languages')}}"> الاقسام الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">تعديل {{$main_cat->name}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.mainCategories.update',$main_cat->id)}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$main_cat -> id}}" name="id" >
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img src="{{$main_cat->photo}}" class="rounded-circle height-150"
                                                    alt="صورة القسم">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label> صوره القسم </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>



                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم القسم
                                                            -{{trans('site.'.$main_cat->translation_lang) }}</label>
                                                        <input type="text" value="{{$main_cat -> name}}" id="name"
                                                            class="form-control" name="category[0][name]">
                                                        @error("category.0.name")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 hidden">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> أختصار اللغة
                                                            - {{trans('site.'.$main_cat->translation_lang) }}

                                                        </label>
                                                        <input type="text" id="translation_lang" class="form-control"
                                                            value=" {{$main_cat -> translation_lang}}"
                                                            name="category[0][abbr]">
                                                        @error("category.0.abbr")
                                                        <span class="text-danger">{{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  ="1"
                                                            name="category[0][active]" id="switcheryColor4"
                                                            class="switchery" data-color="success" @if($main_cat
                                                            ->active == 1)
                                                        checked @endif />
                                                        <label for="switcheryColor4" class="card-title ml-1">الحالة
                                                            - {{__('site.'.$main_cat->translation_lang) }}
                                                        </label>

                                                        @error('category.0.active')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>

                                    <ul class="nav nav-tabs">
                                        @isset($main_cat->categories)
                                            @foreach($main_cat->categories as $index => $trans)
                                        <li class="nav-item">
                                            <a class="nav-link {{$index == 0 ? 'active' : '' }}" id="homeLable-tab" data-toggle="tab" href="#homeLable{{$index}}" aria-controls="homeLable"
                                               aria-expanded="{{$index == 0 ? 'true' : 'false' }}">
                                                {{$trans->translation_lang}}</a>
                                        </li>
                                            @endforeach
                                        @endisset
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        @isset($main_cat->categories)
                                            @foreach($main_cat->categories as $index => $trans)

                                        <div role="tabpanel" class="tab-pane {{$index == 0 ? 'active' : '' }}" id="homeLable{{$index}}" aria-labelledby="homeLable-tab"
                                             aria-expanded="{{$index == 0 ? 'true' : 'false' }}">

                                            <form class="form" action="{{route('admin.mainCategories.update',$trans->id)}}"
                                                  method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="{{$trans -> id}}" name="id" >




                                                <div class="form-body">
                                                    <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> اسم القسم
                                                                    -{{trans('site.'.$trans->translation_lang) }}</label>
                                                                <input type="text" value="{{$trans -> name}}" id="name"
                                                                       class="form-control" name="category[0][name]">
                                                                @error("category.0.name")
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 hidden">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> أختصار اللغة
                                                                    - {{trans('site.'.$trans->translation_lang) }}

                                                                </label>
                                                                <input type="text" id="translation_lang" class="form-control"
                                                                       value=" {{$trans -> translation_lang}}"
                                                                       name="category[0][abbr]">
                                                                @error("category.0.abbr")
                                                                <span class="text-danger">{{$message}} </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox"  value="1"
                                                                name="category[0][active]" id="switcheryColor4"
                                                                class="switchery" data-color="success" @if($trans
                                                            ->active == 1)
                                                                    checked @endif />
                                                                <label for="switcheryColor4" class="card-title ml-1">الحالة
                                                                    - {{__('site.'.$trans->translation_lang) }}
                                                                </label>

                                                                @error('category.0.active')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                        <i class="ft-x"></i> تراجع
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> حفظ
                                                    </button>
                                                </div>
                                            </form>

                                        </div>

                                            @endforeach
                                        @endisset
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>




@endsection
