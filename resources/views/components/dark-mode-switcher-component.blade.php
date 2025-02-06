{{-- filepath: /Users/aldoyh/Herd/Laravel-Ollama/resources/views/components/dark-mode-switcher-component.blade.php --}}
<div x-data="{ darkMode: false }" 
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? window.matchMedia('(prefers-color-scheme: dark)').matches;
        $watch('darkMode', value => {
            localStorage.setItem('darkMode', value);
            if (value) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    "
    class="transition-all duration-300"
>
    <button 
        @click="darkMode = !darkMode"
        class="rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 transition-colors duration-200"
        aria-label="Toggle dark mode"
        title="Toggle dark mode"
    >
        <svg 
            x-cloak
            x-show="!darkMode"
            class="w-5 h-5 text-gray-500 dark:text-gray-400" 
            fill="currentColor" 
            viewBox="0 0 20 20"
        >
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
        </svg>
        <svg 
            x-cloak
            x-show="darkMode"
            class="w-5 h-5 text-gray-500 dark:text-gray-400" 
            fill="currentColor" 
            viewBox="0 0 20 20"
        >
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
        </svg>
    </button>
</div>