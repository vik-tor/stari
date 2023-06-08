<script lang="ts">
	import { prettyDate } from '../utils';

	export let title: string;
	export let date: string;
	export let time: string;
	export let body: string;
</script>

<div class="h-screen">
	<div class="flex-col justify-center">
		<div class="flex flex-col mb-8">
			<div class="h-16 fixed border-b">Stats</div>
			<div class="flex flex-row justify-between w-full mb-4">
				<h2 class="card-title text-xl">
					<span class="">{title}</span>
				</h2>
				<div class="flex items-center">
					<span class="badge badge-accent badge-lg rounded font-black">{time}</span>
					<div class="mx-3 opacity-50">|</div>
					<span class="text-sm italic">{prettyDate(date, 'yyyy-MM-dd', 'EEEE, MMMM d, yyyy')}</span>
				</div>
			</div>
			<hr class="w-full border-gray-500 opacity-50" />
			<!-- <div class="italic" >
				{prettyDate(date, 'yyyy-MM-dd', 'EEEE, do MMMM, yyyy')}
			</div> -->
		</div>

		<div class="card-content">
			<p class="leading-7" style="white-space: pre-wrap;">{@html body}</p>
		</div>
	</div>
</div>

<style>
	.card-title {
		font-size: 24px;
		font-weight: bold;
		text-underline-offset: 2px;
	}
	.card-content {
		font-family: 'Lato', sans-serif;
		line-height: 1.5rem;
	}
</style>
