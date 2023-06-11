<script>
    import { getContext } from "svelte";
    import { tabContextId } from "./Tabs.svelte";

    export let id;

    const { selectedTab, selectTab } = getContext(tabContextId);
</script>

<!-- svelte-ignore a11y-missing-attribute -->
<!-- svelte-ignore a11y-click-events-have-key-events -->
<a
    class="tab tab-bordered border-secondary text-base-100 text-xs font-semibold {$selectedTab ===
    id
        ? 'border-accent'
        : ''}"
    on:click={() => selectTab(id)}><slot /></a
>
