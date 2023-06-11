<script>
    export let name;
    export let title;
    // Classes for border-color, background, width, text-color
    export let classes;
    export let closable = true;
</script>

<dialog id={name} class="modal">
    <form
        method="dialog"
        class="modal-box rounded p-0 border bg-primary {classes}"
    >
        <div class="flex justify-between items-center px-3 py-1">
            <h3 class="text-sm font-semibold leading-none">
                {title}
            </h3>
            {#if closable}
                <button for={name} class="btn btn-xs btn-circle btn-ghost">
                    <i class="bi bi-x text-base" />
                </button>
            {/if}
        </div>
        <hr class="w-full border border-secondary border-opacity-50 mr-auto" />
        <div class="px-2">
            <slot />
        </div>
    </form>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
