<body>
<main id="@yield('body.id', 'app')" class="@yield('body.class')">
	@yield('body')
</main>

@stack('body.scripts')

<div class="graphicons" hidden>
	<svg xmlns="http://www.w3.org/2000/svg"
	     viewBox="0 0 48 48"
	     style="enable-background:new 0 0 48 48;fill:#000000;">
		<g id="globe">
			<circle style="fill:#1565C0;" cx="24" cy="24" r="20"></circle>
			<path style="fill:#43A047;"
			      d="M32.273,14.541l-1.937,1.465c-0.315,0.28-0.421,0.727-0.264,1.119l0.894,1.125  c0.12,0.448-0.083,0.916-0.49,1.138c-0.539,0.295-1.739,0.895-1.739,1.243c0,0.711,0.484,2.368,0.947,2.368  c3.058,0,1.184-1.421,3.434-2.842C34.424,19.333,36.526,19,37,19h2v14h-7c0,0,1.204,1.901,2.313,4C34.824,37.969,36,40,36,40  c5.071-3.859,8-9.775,8-16c0-6.44-3.056-12.152-7.783-15.81l-2.93,5.104C33.019,13.761,32.676,14.183,32.273,14.541z"></path>
			<path style="fill:#43A047;"
			      d="M14.125,25C15.013,25.016,15,24.184,15,23c0-1.242-0.197-3,3-3c1.303,0,3,0.013,3-2c0-0.829,0-4,0-5  c0-0.277-0.125-1.625-2.125-1.625c-1.717,0-3-0.25-3-1.5c0-0.88,0.669-3.029,2.085-4.942C10.639,7.25,5.156,13.668,4.174,21.489  L4,23c2.171,0,7.822,0,8,0C13.5,23,13.237,24.984,14.125,25z"></path>
			<path style="fill:#43A047;"
			      d="M23,31c-1.184,0-2,0-3.423-1.697C19.05,28.674,18.148,28,17.441,28s-1.574,0-1.574,0H15l-1,1l2,7  v6.281c0.98,0.428,1.988,0.805,3.043,1.075C19.41,40.215,21.807,36.579,22,36c0.207-0.413,1-2.25,1-2.25S23.017,31,23,31z"></path>
			<path style="fill:#7CB342;"
			      d="M37,19c0,0,1,1,1,4c0,1-2,2-5,2c-5,0-5,2.928-5,4c0,3.553,4,4,4,4s4,0,7,4  c0.029,0.039,0.062,0.066,0.093,0.096C42.142,33.585,44,29.014,44,24c0-3.449-0.873-6.694-2.411-9.526L41.311,14H41  C38,14,38.302,18.001,37,19z"></path>
			<path style="fill:#7CB342;"
			      d="M6,24c0.621,1.242,2.058,2.326,3.3,3.153C10.129,27.774,13,29,13,31c0,3.368,2,7,2,9v1.843l2,0.898  c0,0,0-1.297,0-1.741c0-3,3.373-5.01,5-5c0,0,2-0.211,2-3.526C24,32.06,23.592,31,23,31c0,0-0.5,2-4.25,2c-2,0-3.75-1.125-3.75-5  h-1.875C12.533,28,12,27.224,12,26.75S11.75,26,11,26c-0.558,0-1-0.315-1-0.75c0-0.375,0-0.933,0-1c0-0.622,0.5-1.25,2-1.25  c0-1.847-2-2.973-2-4.5c0-1.375-1-3.5-3-4.5l-0.271-0.064c0,0-2.129,3.593-2.525,7.502L6,24z"></path>
			<circle style="fill:none;stroke:#BBDEFB;stroke-width:3;stroke-miterlimit:10;" cx="24" cy="24"
			        r="19.5"></circle>
		</g>
	</svg>
</div>
</body>