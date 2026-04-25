@extends('admin::core.master')

@section('title', __('Slides'))

@section('content')
    <item-list url-base="/api/slides" fields="id,image_id,position,status,body" table="slides" title="slides" include="image" :searchable="['body']" :sorting="['position']">
        <template #top-buttons v-if="$can('create slides')">
            <x-core::create-button :url="route('admin::create-slide')" :label="__('Create slide')" />
        </template>

        <template #columns="{ sortArray }">
            <item-list-column-header name="checkbox" v-if="$can('update slides')||$can('delete slides')"></item-list-column-header>
            <item-list-column-header name="edit" v-if="$can('update slides')"></item-list-column-header>
            <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
            <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Position')"></item-list-column-header>
            <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
            <item-list-column-header name="body_translated" sortable :sort-array="sortArray" :label="$t('Content')"></item-list-column-header>
        </template>

        <template #table-row="{ model, checkedModels, loading, toggleStatus }">
            <td class="checkbox" v-if="$can('update slides')||$can('delete slides')">
                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
            </td>
            <td v-if="$can('update slides')">
                <item-list-edit-button :url="'/admin/slides/' + model.id + '/edit'"></item-list-edit-button>
            </td>
            <td>
                <item-list-status-button :model="model"></item-list-status-button>
            </td>
            <td>
                <item-list-position-input :model="model"></item-list-position-input>
            </td>
            <td><img :src="model.thumb" alt="" height="27" /></td>
            <td>@{{ model.body_translated }}</td>
        </template>
    </item-list>
@endsection
