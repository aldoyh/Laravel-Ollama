import './bootstrap';

// Constants

const SELECTORS = {
    spinner: '#spinner',
    response: '#response',
    form: '#ollamaPrompt',
    input: '#promptText',
    submit: '#submit',
    responseBody: '#response--body'
};

// Event Handlers
document.addEventListener('DOMContentLoaded', () => {
    const elements = getElements();

    // Hide spinner on load
    elements.spinner.classList.add('hidden');

    // Form submission
    elements.form.addEventListener('submit', () => {
        elements.spinner.classList.remove('hidden');
        elements.response.classList.add('hidden');
    });

    // Input validation
    elements.input.addEventListener('input', (e) => {
        elements.submit.disabled = !e.target.value.trim();
    });
});

// Utility Functions
const getElements = () => ({
    spinner: document.querySelector(SELECTORS.spinner),
    response: document.querySelector(SELECTORS.response),
    form: document.querySelector(SELECTORS.form),
    input: document.querySelector(SELECTORS.input),
    submit: document.querySelector(SELECTORS.submit),
    responseBody: document.querySelector(SELECTORS.responseBody)
});

window.copyToClipboard = async () => {
    try {
        const responseText = document.querySelector(SELECTORS.responseBody).innerHTML;
        const formattedText = htmlToText(responseText);
        await navigator.clipboard.writeText(formattedText);
        console.log('Content copied to clipboard');
    } catch (err) {
        console.error('Failed to copy:', err);
    }
};

window.htmlToText = (html) => {
    const replacements = [
        [/\n/g, ''],
        [/<style([\s\S]*?)<\/style>/gi, ''],
        [/<script([\s\S]*?)<\/script>/gi, ''],
        [/<a.*?href="(.*?)[\?\"].*?>(.*?)<\/a.*?>/gi, ' $2 $1 '],
        [/<\/div>/gi, '\n\n'],
        [/<\/li>/gi, '\n'],
        [/<li.*?>/gi, '  *  '],
        [/<\/ul>/gi, '\n\n'],
        [/<\/p>/gi, '\n\n'],
        [/<br\s*[\/]?>/gi, '\n'],
        [/<[^>]+>/gi, ''],
        [/^\s*/gm, ''],
        [/ ,/g, ','],
        [/ +/g, ' '],
        [/\n+/g, '\n\n'],
        [/;/g, ';\n\n']
    ];

    return replacements.reduce((text, [pattern, replacement]) =>
        text.replace(pattern, replacement), html);
};
