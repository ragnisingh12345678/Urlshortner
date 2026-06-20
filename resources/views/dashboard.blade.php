<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - Role: <span class="text-blue-600">{{ auth()->user()->role }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                    {{ session('success') }}
                </div>
            @endif

            @if(auth()->user()->role === 'SuperAdmin')
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">Add New Company</h2>
                <form method="POST" action="{{ route('companies.store') }}" class="mt-4 flex gap-4">
                    @csrf
                    <x-text-input name="name" type="text" placeholder="Company Name" class="w-full" required />
                    <x-primary-button>Create Company</x-primary-button>
                </form>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">Invite a User</h2>
                <form method="POST" action="{{ route('invite') }}" class="mt-4 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <x-text-input name="email" type="email" placeholder="User Email" required />
                        <select name="role" class="border-gray-300 rounded-md" required>
                            <option value="">Select Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Member">Member</option>
                        </select>
                        <select name="company_id" class="border-gray-300 rounded-md" required>
                            <option value="">Select Company</option>
                            @foreach(\App\Models\Company::all() as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                         <x-primary-button>Send Invite</x-primary-button>
                    </div>
                   
                </form>
            </div>

            @if(auth()->user()->role !== 'SuperAdmin')
            <div class="p-4 sm:p-8 bg-blue-50 shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">🔗 Create Short URL</h2>
                <form method="POST" action="{{ route('urls.store') }}" class="mt-4 flex gap-4">
                    @csrf
                    <x-text-input name="original_url" type="url" placeholder="https://example.com" class="w-full" required />
                    <x-primary-button>Generate URL</x-primary-button>
                </form>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900"> Short URLs List</h2>
                <div class="mt-4 overflow-hidden border border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Short Code</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Original URL</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Company</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($urls as $url)

                                <tr>
                                    <td class="px-3 py-4 text-sm text-gray-500"><a
                                        href="{{ url($url->short_code) }}"
                                        target="_blank"
                                        class="text-blue-600 underline">
                                        {{ url($url->short_code) }}
                                    </a></td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $url->original_url }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $url->user?->email ?? 'N/A' }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $url->company?->name ?? 'N/A' }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $url->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center p-4 text-gray-500">No URLs found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>