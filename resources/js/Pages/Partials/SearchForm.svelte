<script>
    import { useForm, router } from "@inertiajs/svelte";

    let search = "";

    const handleSearch = () => {};
</script>

<form class="py-1 border-b border-secondary border-opacity-50" action="">
    <div class="flex items-center">
        <span class="ml-5 text-slate-500 dark:text-slate-300">
            <i class="bi bi-search text-xs" />
        </span>
        <input
            type="search"
            name="search"
            id="search"
            placeholder="Search..."
            class="w-full input input-md bg-transparent rounded-none border-none pl-3 focus:outline-0 focus:ring-0 placeholder:text-slate-500 dark:placeholder:text-slate-300"
            bind:value={search}
            on:keyup={handleSearch}
        />
    </div>
</form>
