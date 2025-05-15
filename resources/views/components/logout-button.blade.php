@auth
    <form action="/logout" method="POST">
        @csrf
        <x-button type="submit">logout</x-button>
    </form>
@endauth