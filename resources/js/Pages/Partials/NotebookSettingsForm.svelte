<script>
    import { useForm } from "@inertiajs/svelte";
</script>

<div class="flex flex-col lg:flex-row text-slate-900 dark:text-slate-50">
    <fieldset class="border border-solid border-gray-300 p-3 w-3/5 mx-auto">
        <legend class="text-xs uppercase">Appearance:</legend>
        <div class="form-control">
            <label class="label cursor-pointer gap-2">
                <span class="label-text text-slate-900 dark:text-slate-50 mr-20"
                    >Color</span
                >
                <input
                    type="radio"
                    name="radio-10"
                    class="radio radio-error"
                    checked
                />
                <input type="radio" name="radio-10" class="radio radio-info" />
                <input
                    type="radio"
                    name="radio-10"
                    class="radio radio-success"
                />
                <input
                    type="radio"
                    name="radio-10"
                    class="radio radio-accent"
                />
                <input
                    type="radio"
                    name="radio-10"
                    class="radio radio-warning"
                />
            </label>
        </div>

        <div class="">
            <span class="label-text text-slate-900 dark:text-slate-50 mb-2"
                >Spacing</span
            >
            <div class="join join-vertical w-full rounded bg-inherit">
                <input
                    class="join-item btn btn-sm text-sm font-normal capitalize justify-start"
                    type="radio"
                    name="options"
                    aria-label="Comfy"
                />
                <input
                    class="join-item btn btn-sm text-sm font-normal capitalize justify-start"
                    type="radio"
                    name="options"
                    aria-label="Normal"
                />
                <input
                    class="join-item btn btn-sm text-sm font-normal capitalize justify-start"
                    type="radio"
                    name="options"
                    aria-label="Condensed"
                />
            </div>
        </div>
    </fieldset>
</div>
