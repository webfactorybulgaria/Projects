@extends('core::admin.master')

@section('title', trans('projects::global.name'))

@section('main')

<div ng-app="typicms" ng-cloak ng-controller="ListController" ng-show="!initializing">

    @include('core::admin._button-create', ['module' => 'projects'])

    <h1>
        <span>@{{ totalModels }} @choice('projects::global.projects', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">
        <table st-persist="projectsTable" st-table="displayedModels" st-order st-sort-default="date" st-sort-default-reverse="true" st-pipe="callServer" st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <td colspan="7" st-items-by-page="itemsByPage" st-pagination="" st-template="/views/partials/pagination.custom.html"></td>
                </tr>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th st-sort="image" class="image st-sort">Image</th>
                    <th st-sort="date" class="date st-sort">Date</th>
                    <th st-sort="title" class="title st-sort">Title</th>
                    <th st-sort="category_id" class="category st-sort">Category</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <select class="form-control" st-input-event="change keydown" st-search="status.boolean">
                            <option value=""></option>
                            <option value="true">Active</option>
                            <option value="false">Not Active</option>
                        </select>
                    </td>
                    <td></td>
                    <td>
                        <datepicker date-format="yyyy-MM-dd" class="filter-date">
                            <input type="text" st-search="date.date.filter_from" class="form-control input-sm" placeholder="From date…">
                        </datepicker>
                        <datepicker date-format="yyyy-MM-dd" class="filter-date">
                            <input type="text" st-search="date.date.filter_to" class="form-control input-sm" placeholder="To date…">
                        </datepicker>
                    </td>
                    <td>
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <select class="form-control" st-input-event="change keydown" ng-model="params.tableState.search.predicateObject.category_id.int"  st-search="category_id.int">
                            <option value=""></option>
                            <option ng-repeat="item in options.categories" value="@{{item.id}}">@{{item.title}}</option>
                        </select>
                    </td>
                </tr>
            </thead>

            <tbody ng-class="{'table-loading':isLoading}">
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                        @include('core::admin._button-edit', ['module' => 'projects'])
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>
                        <img ng-src="@{{ model.thumb }}" alt="">
                    </td>
                    <td>@{{ model.date | dateFromMySQL:'dd/MM/yyyy' }}</td>
                    <td>@{{ model.title }}</td>
                    <td>@{{ model.category_name }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" st-items-by-page="itemsByPage" st-pagination="" st-template="/views/partials/pagination.custom.html"></td>
                    <td>
                        <div ng-include="'/views/partials/pagination.itemsPerPage.html'"></div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@endsection
