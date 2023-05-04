<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('owner.comments.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Back to Manage Comment</a>
            </div>

            <div class="m-2 p-2 bg-slate-200 rounded-2xl">
                <div>
                    <p class="font-bold text-2xl">Reply Section</p>
                </div>
                <div class="space-y-4 divide-y divide-gray-200 bg-slate-100 w-full mt-10">
                    @foreach ($repliedComments as $comment)
                        <div class="comment flex py-4" style="padding-top: 1rem;">
                            <div class="comment-avatar">
                                <img src="{{ Storage::url($comment->user->image) }}" alt="User"
                                    class="h-10 w-10 rounded-full mr-2 ml-2 border-2 border-gray-200">
                            </div>
                            <div class="comment-content">
                                <div class="comment-header flex items-center ml-4">
                                    <span class="user-name font-bold">{{ $comment->user->name }}</span>
                                    <span
                                        class="posted-for text-gray-600 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-body text-gray-700 ml-4">
                                    {{ $comment->comment }}
                                </div>
                                @if ($comment->user->id == auth()->user()->id)
                                    <form action="{{ route('owner.comments.destroy', ['comments' => $comment->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-button text-red-500 text-sm ml-5 mt-2 inline-block px-2 py-1 rounded-md bg-white border border-red-500 hover:shadow-md hover:scale-105 transition-all duration-300">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        @foreach ($comment->child as $child)
                            <div class="comment flex py-1 ml-12">
                                <div class="comment-avatar">
                                    <img src="{{ Storage::url($child->user->image) }}" alt="User"
                                        class="h-10 w-10 rounded-full mr-2 ml-2 border-2 border-gray-200">
                                </div>
                                <div class="comment-content">
                                    <div class="comment flex items-center mb-1 ml-4">
                                        <span class="user-name font-bold">{{ $child->user->name }}</span>
                                        <span class="posted-for text-gray-600 text-sm ml-2">5 minutes ago</span>
                                    </div>
                                    <div class="comment-body text-gray-700 ml-4">
                                        {{ $child->comment }}
                                    </div>
                                    @if ($child->user->id == auth()->user()->id)
                                        <form
                                            action="{{ route('owner.comments.destroy', ['comments' => $child->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="delete-button text-red-500 text-sm ml-5 mt-2 inline-block px-2 py-1 rounded-md bg-white border border-red-500 hover:shadow-md hover:scale-105 transition-all duration-300">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                    <form action="{{ route('owner.comments.reply.send', $restaurant->id) }}" method="POST"
                        class="comment-form mt-4 px-4 py-4 flex items-center justify-between">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                        <textarea name="comment"
                            class="comment-input w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500"
                            placeholder="Leave a comment" style="height: 100px;"></textarea>
                        <button type="submit"
                            class="comment-button bg-blue-500 text-white font-bold py-1 px-2 ml-2 rounded">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-owner-layout>
