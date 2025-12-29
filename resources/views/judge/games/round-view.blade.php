<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center p-4">
        <div class="w-full max-w-3xl">
            <!-- Top Bar -->
            <div class="mb-8 flex justify-between items-center">
                <a href="{{ route('games.show', $round->game) }}" class="text-white hover:text-blue-200 font-semibold text-lg">← Back</a>
                <div class="text-white text-center">
                    <p class="text-sm opacity-75">{{ $round->team === 'team_1' ? $round->game->team_1_name : $round->game->team_2_name }}</p>
                    <p class="text-2xl font-bold">{{ $round->category->name }}</p>
                </div>
                <div class="text-white text-right">
                    <p class="text-xs opacity-75">Difficulty</p>
                    <p class="text-lg font-bold capitalize">{{ $round->question->difficulty }}</p>
                </div>
            </div>

            <!-- Question Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-12 mb-8 animate-in fade-in slide-in-from-top duration-500">
                <h2 class="text-4xl font-bold text-gray-900 mb-8 leading-tight text-center">
                    {{ $round->question->content }}
                </h2>

                @if($round->question->hint)
                    <div class="bg-blue-50 border-2 border-blue-300 rounded-xl p-6">
                        <p class="text-sm font-semibold text-blue-900 mb-2">💡 Hint Available</p>
                        <p class="text-blue-900">{{ $round->question->hint }}</p>
                    </div>
                @endif
            </div>

            <!-- Answer Display for Judge -->
            <div class="bg-white rounded-3xl shadow-2xl p-12 mb-8">
                <p class="text-sm font-semibold text-gray-600 text-center mb-4 uppercase tracking-widest">The Answer Is:</p>
                <p class="text-5xl font-black text-center text-blue-600 mb-6">{{ $round->question->answer }}</p>
                <p class="text-center text-gray-600 italic">Judge: Verify if the team shouted the correct answer</p>
            </div>

            <!-- Judge's Award Decision -->
            @if($round->status === 'pending')
                <form action="{{ route('games.score-round', $round) }}" method="POST" class="space-y-6 animate-in fade-in slide-in-from-bottom duration-500">
                    @csrf

                    <p class="text-white text-center text-xl font-semibold">Who should get the points?</p>

                    <div class="grid grid-cols-3 gap-4">
                        <button type="submit" name="award_team" value="team_1" class="bg-gradient-to-br from-blue-500 to-blue-600 text-white px-6 py-8 rounded-2xl font-bold text-lg hover:shadow-2xl transition transform hover:scale-105 active:scale-95">
                            {{ $round->game->team_1_name }}<br><span class="text-sm opacity-75">Award Points</span>
                        </button>

                        <button type="submit" name="award_team" value="no_one" class="bg-gradient-to-br from-gray-500 to-gray-600 text-white px-6 py-8 rounded-2xl font-bold text-lg hover:shadow-2xl transition transform hover:scale-105 active:scale-95">
                            Neither<br><span class="text-sm opacity-75">No Points</span>
                        </button>

                        <button type="submit" name="award_team" value="team_2" class="bg-gradient-to-br from-red-500 to-red-600 text-white px-6 py-8 rounded-2xl font-bold text-lg hover:shadow-2xl transition transform hover:scale-105 active:scale-95">
                            {{ $round->game->team_2_name }}<br><span class="text-sm opacity-75">Award Points</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-white rounded-3xl shadow-2xl p-10 animate-in zoom-in duration-300">
                    <p class="text-center text-gray-600 mb-8">Round completed</p>
                    <a href="{{ route('games.show', $round->game) }}" class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl font-bold text-lg hover:shadow-lg transition transform hover:scale-105">
                        → Back to Game
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
