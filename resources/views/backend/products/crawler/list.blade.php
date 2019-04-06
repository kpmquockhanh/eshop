@extends('backend.layouts.master')
@section('title', "Crawler")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Crawler</h4>
                        <div class="row">
                            <div class="col-12 float-right">
                                <a href="#" class="btn-lg btn-success pull-right w-100" style="display: flex; justify-content: center; text-decoration: none;">
                                    <i class="fa fa-sync-alt fa-spin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover" style="overflow: hidden;">
                            <table class="table">
                                <thead class="text-primary">
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Link
                                    </th>
                                    <th>
                                        Crawled Item
                                    </th>
                                    <th>
                                        Action
                                </tr>
                                </thead>
                                <tbody>
                                @if (!count($links))
                                    <tr>
                                        <td class="text-center" colspan="6">Không có url nào crawl được
                                        </td>
                                    </tr>
                                @endif
                                @foreach($links as $index => $link)
                                    <tr>
                                        <td class="{{$link['count'] == 0? 'text-danger':'text-success'}}">
                                            {{$link['name']}}
                                        </td>
                                        <td>
                                            <a href="{{$link['link']}}" target="_blank">{{$link['link']}}</a>
                                        </td>
                                        <td >
                                            {{$link['count']}}
                                        </td>
                                        <td class="text-center">
                                            <a href="#" rel="tooltip"
                                               class="btn-lg btn-success btn-icon btn-sm btn-download" data-index="{{$index}}"
                                               title="">
                                                <i class="fa fa-download"></i>
                                                {{--<i class="fas fa-spinner fa-spin"></i>--}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
