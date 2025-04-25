<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activity Log Details') }}
            </h2>
            <a href="{{ route('admin.activity-logs.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 text-sm flex items-center hover:bg-gray-300">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('Back to Logs') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Log Information') }}</h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="text-sm font-medium text-gray-500">{{ __('User') }}</div>
                                    <div class="mt-1 text-gray-900">{{ $activityLog->user ? $activityLog->user->name : 'System' }}</div>
                                </div>
                                
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Action') }}</div>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $activityLog->action == 'create' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $activityLog->action == 'update' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $activityLog->action == 'delete' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($activityLog->action) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-span-2">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Resource') }}</div>
                                    <div class="mt-1 text-gray-900">{{ class_basename($activityLog->model_type) }} #{{ $activityLog->model_id }}</div>
                                </div>
                                
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="text-sm font-medium text-gray-500">{{ __('Date & Time') }}</div>
                                    <div class="mt-1 text-gray-900">{{ $activityLog->created_at->format('d M Y, H:i:s') }}</div>
                                </div>
                                
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="text-sm font-medium text-gray-500">{{ __('IP Address') }}</div>
                                    <div class="mt-1 text-gray-900">{{ $activityLog->ip_address ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Changes') }}</h3>
                            
                            @if($activityLog->action == 'create')
                                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                                    <h4 class="font-medium text-green-800">{{ __('New Record Created') }}</h4>
                                    
                                    @if(is_array($activityLog->new_values) && count($activityLog->new_values) > 0)
                                        <div class="mt-2 space-y-2">
                                            @foreach($activityLog->new_values as $key => $value)
                                                <div class="grid grid-cols-3 text-sm">
                                                    <div class="font-medium text-gray-600">{{ $key }}</div>
                                                    <div class="col-span-2 text-green-700">
                                                        @if(is_array($value))
                                                            <pre class="whitespace-pre-wrap">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                        @else
                                                            {{ $value === '' ? '[empty]' : $value }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-600 mt-2">{{ __('No detailed information available.') }}</p>
                                    @endif
                                </div>
                            @elseif($activityLog->action == 'update')
                                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                    <h4 class="font-medium text-blue-800">{{ __('Record Updated') }}</h4>
                                    
                                    @if(is_array($activityLog->old_values) && is_array($activityLog->new_values) && 
                                        (count($activityLog->old_values) > 0 || count($activityLog->new_values) > 0))
                                        <div class="mt-2 space-y-3">
                                            @foreach($activityLog->new_values as $key => $value)
                                                <div class="grid grid-cols-3 text-sm">
                                                    <div class="font-medium text-gray-600">{{ $key }}</div>
                                                    <div class="text-red-600 line-through">
                                                        @if(isset($activityLog->old_values[$key]))
                                                            @if(is_array($activityLog->old_values[$key]))
                                                                <pre class="whitespace-pre-wrap">{{ json_encode($activityLog->old_values[$key], JSON_PRETTY_PRINT) }}</pre>
                                                            @else
                                                                {{ $activityLog->old_values[$key] === '' ? '[empty]' : $activityLog->old_values[$key] }}
                                                            @endif
                                                        @else
                                                            [null]
                                                        @endif
                                                    </div>
                                                    <div class="text-green-600">
                                                        @if(is_array($value))
                                                            <pre class="whitespace-pre-wrap">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                        @else
                                                            {{ $value === '' ? '[empty]' : $value }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-600 mt-2">{{ __('No changes detected or available.') }}</p>
                                    @endif
                                </div>
                            @elseif($activityLog->action == 'delete')
                                <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                                    <h4 class="font-medium text-red-800">{{ __('Record Deleted') }}</h4>
                                    
                                    @if(is_array($activityLog->old_values) && count($activityLog->old_values) > 0)
                                        <div class="mt-2 space-y-2">
                                            @foreach($activityLog->old_values as $key => $value)
                                                <div class="grid grid-cols-3 text-sm">
                                                    <div class="font-medium text-gray-600">{{ $key }}</div>
                                                    <div class="col-span-2 text-red-700">
                                                        @if(is_array($value))
                                                            <pre class="whitespace-pre-wrap">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                        @else
                                                            {{ $value === '' ? '[empty]' : $value }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-600 mt-2">{{ __('No detailed information available about the deleted record.') }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($activityLog->user_agent)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('User Agent') }}</h3>
                            <div class="text-sm text-gray-600 font-mono bg-gray-50 p-3 rounded">
                                {{ $activityLog->user_agent }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 