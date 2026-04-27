@extends('admin::core.master')

@section('title', __('Slides'))

@section('content')
    <item-list url-base="/api/slides" fields="id,image_id,position,status,body" table="slides" title="slides" include="image" :searchable="['body']" :sorting="['position']" :draggable="$can('update slides')">
        <template #top-buttons v-if="$can('create slides')">
            <x-core::create-button :url="route('admin::create-slide')" :label="__('Create slide')" />
        </template>

        <template #columns="{ sortArray }">
            <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Order')"></item-list-column-header>
            <item-list-column-header name="checkbox" v-if="$can('update slides')||$can('delete slides')"></item-list-column-header>
            <item-list-column-header name="edit" v-if="$can('update slides')"></item-list-column-header>
            <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
            <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
            <item-list-column-header name="body_translated" sortable :sort-array="sortArray" :label="$t('Content')"></item-list-column-header>
        </template>

        <template #table-row="{ model, checkedModels, loading, sortArray }">
            <td class="drag-handle text-muted" v-if="$can('update partners')" :style="{ cursor: sortArray[0] === 'position' ? 'grab' : 'default' }">
                <i :class="['icon-grip-vertical', { 'opacity-50': sortArray[0] !== 'position' }]"></i>
            </td>
            <td class="checkbox" v-if="$can('update slides')||$can('delete slides')">
                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
            </td>
            <td v-if="$can('update slides')">
                <item-list-edit-button :url="'/admin/slides/' + model.id + '/edit'"></item-list-edit-button>
            </td>
            <td>
                <item-list-status-button :model="model"></item-list-status-button>
            </td>
            <td><img v-if="model.image_id" :src="model.thumb" alt="" height="27" /></td>
            <td>@{{ model.body_translated }}</td>
        </template>
    </item-list>
@endsection
