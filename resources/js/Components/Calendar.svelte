<script lang="ts">
	import { days, months } from '../utils';

	export let times: string[];

	let calendar: {
		month: string;
		year: string;
		weeks: {}[][];
	};

	let today = new Date();
	let currentMonth = today.getMonth();
	let currentYear = today.getFullYear();
	let selectYear = latest().year;
	let selectMonth = (parseInt(latest().month) - 1).toString();

	calendar = createCalendar((parseInt(latest().month) - 1).toString(), latest().year);

	function latest(): { month: string; year: string } {
		const item = times.slice(-1);
		const last = item[0].split('-');
		const my = {
			month: last[1],
			year: last[0]
		};
		return my;
	}

	function years(): number[] {
		let years: number[];
		years = [];
		times.reduce((acc, item: string) => {
			let params = item.split('-');
			years.push(parseInt(params[0]));
			return acc;
		});
		years = [...new Set(years)];
		return years;
	}

	function localise(i: string) {
		let sp = i.split('');
		if (sp.length < 2) return '0' + i;
		else return i;
	}

	function hasDay(date: string, month: string, year: string): boolean {
		const mnth = (parseInt(month) + 1).toString();
		const key = year + '-' + localise(mnth);
		const key2 = key + '-' + localise(date);

		let res = times.filter((item) => item.includes(key));
		let result = [...new Set(res)];

		if (result.includes(key2)) return true;
		else return false;
	}

	function hasMonth(month: string, year: string): boolean {
		const mnth = (parseInt(month) + 1).toString();
		const key = year;
		const key2 = key + '-' + localise(mnth);

		let res = times.filter((item) => item.includes(key));
		let result = [...new Set(res)];

		if (result.includes(key2)) return true;
		else return false;
	}

	function next() {
		currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
		currentMonth = (currentMonth + 1) % 12;
		calendar = createCalendar(currentMonth.toString(), currentYear.toString());
		calendar = calendar;
	}
	function previous() {
		currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
		currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
		calendar = createCalendar(currentMonth.toString(), currentYear.toString());
		calendar = calendar;
	}
	function jump() {
		calendar = createCalendar(selectMonth, selectYear);
		calendar = calendar;
	}

	function daysInMonth(iMonth: number, iYear: number) {
		return 32 - new Date(iYear, iMonth, 32).getDate();
	}

	function createCalendar(month: string, year: string) {
		const workingDate = new Date(parseInt(year), parseInt(month));
		const dayOne = workingDate.getDay();

		let week: (typeof day)[];
		let day: {
			date: string;
			selected?: boolean;
		};
		interface monthType {
			month: string;
			year: string;
			weeks: (typeof week)[];
		}

		let monthData: monthType = {
			month: workingDate.getMonth().toString(),
			year: year,
			weeks: []
		};

		var date = 1;
		for (var i = 0; i < 6; i++) {
			week = [];
			for (var j = 0; j < 7; j++) {
				if (i === 0 && j < dayOne) {
					day = {
						date: ''
					};
					week.push(day);
				} else if (date > daysInMonth(parseInt(month), parseInt(year))) {
					break;
				} else {
					day = {
						date: date.toString(),
						selected: false
					};

					/* if (
          date === today.getDate() &&
          year === today.getFullYear() &&
          month === today.getMonth()
        ) {
          day.selected = true
        } */
					week.push(day);
					date++;
				}
			}

			monthData.weeks.push(week);
		}
		return monthData;
	}
</script>

<div class="flex items-center justify-center px-4">
	<div class="max-w-sm w-full">
		<div class="card p-8 dark:bg-gray-700 bg-white rounded">
			<div class="px-4 flex items-center justify-between">
				<span
					tabindex="-1"
					class="focus:outline-none  text-base font-bold dark:text-gray-100 text-gray-800"
					>{months[parseInt(calendar.month)]} {calendar.year}</span
				>
				<div class="flex items-center">
					<button
						aria-label="calendar backward"
						class="focus:text-gray-400 hover:text-gray-400 text-gray-800 dark:text-gray-100"
						on:click={previous}
					>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							class="icon icon-tabler icon-tabler-chevron-left"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							stroke-width="1.5"
							stroke="currentColor"
							fill="none"
							stroke-linecap="round"
							stroke-linejoin="round"
						>
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<polyline points="15 6 9 12 15 18" />
						</svg>
					</button>
					<button
						aria-label="calendar forward"
						class="focus:text-gray-400 hover:text-gray-400 ml-3 text-gray-800 dark:text-gray-100"
						on:click={next}
					>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							class="icon icon-tabler  icon-tabler-chevron-right"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							stroke-width="1.5"
							stroke="currentColor"
							fill="none"
							stroke-linecap="round"
							stroke-linejoin="round"
						>
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<polyline points="9 6 15 12 9 18" />
						</svg>
					</button>
				</div>
			</div>
			<div class="flex items-center justify-between pt-12 overflow-x-auto">
				<table class="w-full ">
					<thead>
						<tr>
							{#each days as day}
								<th>
									<div class="w-full flex justify-center">
										<p class="text-base font-medium text-center text-gray-800 dark:text-gray-300">
											{day}
										</p>
									</div>
								</th>
							{/each}
						</tr>
					</thead>
					<tbody>
						{#each calendar.weeks as week}
							<tr>
								{#each week as day}
									<td class="date">
										{#if hasDay(day.date, calendar.month, calendar.year)}
											<a
												class="p-2 flex w-full justify-center dark:bg-slate-800 rounded-full"
												href={'#' +
													calendar.year +
													'-' +
													localise((parseInt(calendar.month) + 1).toString()) +
													'-' +
													localise(day.date)}
											>
												<span class="text-gray-900 dark:text-gray-100">{day.date}</span>
											</a>
										{:else}
											<div class="p-2 flex w-full justify-center">
												<p
													class="text-base text-gray-500 dark:text-gray-100 font-medium rounded-full"
												>
													<span>{day.date}</span>
												</p>
											</div>
										{/if}
									</td>
								{/each}
							</tr>
						{/each}
					</tbody>
				</table>
			</div>
			<div class="flex justify-evenly w-full mt-8">
				<div class="footer-container-calendar">
					<label for="month">Jump To: </label>
					<select class="cursor-auto" bind:value={selectMonth} on:change={jump}>
						{#each months as month, idx}
							<option value={idx}>
								<span
									class={hasMonth(idx.toString(), calendar.year)
										? 'bg-red text-red-700'
										: 'text-blue-400'}>{month}</span
								>
							</option>
						{/each}
					</select>
					<select id="year" bind:value={selectYear} on:change={jump}>
						{#each years() as year}
							<option value={year}>{year}</option>
						{/each}
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	/* sunday */
	.date:nth-child(1) span {
		color: red;
	}
	/* friday */
	.date:nth-child(7) span {
		color: green;
	}
	@media (prefers-color-scheme: dark) {
		.date:nth-child(1) span {
			color: orangered;
		}
		.date:nth-child(7) span {
			color: yellow;
		}
	}
</style>
