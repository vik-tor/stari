<script>
    import { getContext } from "svelte";
    import { tabContextId } from "./Tabs.svelte";

    export let id;

    const { selectedTab } = getContext(tabContextId);
</script>

{#if $selectedTab === id}
    <div
        class="flex flex-col w-full p-3 text-slate-900 dark:text-slate-50 overflow-auto"
    >
        <slot />
    </div>
{/if}
