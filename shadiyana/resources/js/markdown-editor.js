import { marked } from 'marked';
import '@celsowm/markdown-wysiwyg/dist/editor.css';

window.marked = marked;

let editorLoaded = false;
let editorLoadingPromise = null;

/**
 * Load Markdown WYSIWYG editor.
 *
 * The package does not expose MarkdownWYSIWYG as an ES module export,
 * so the editor script is loaded separately.
 */
function loadMarkdownWysiwyg() {

    if (window.MarkdownWYSIWYG) {
        editorLoaded = true;

        return Promise.resolve();
    }

    if (editorLoadingPromise) {
        return editorLoadingPromise;
    }

    editorLoadingPromise = new Promise((resolve, reject) => {

        const script = document.createElement('script');

        script.src = '/vendor/markdown-wysiwyg/editor.js';

        script.onload = () => {
            editorLoaded = true;
            resolve();
        };

        script.onerror = () => {
            reject(
                new Error(
                    'Failed to load Markdown WYSIWYG editor.'
                )
            );
        };

        document.head.appendChild(script);
    });

    return editorLoadingPromise;
}


/**
 * Initialize all Markdown editors on the current page.
 */
export async function initializeMarkdownEditor() {

    const elements = document.querySelectorAll(
        '[data-markdown-editor]'
    );

    if (!elements.length) {
        return;
    }

    try {

        await loadMarkdownWysiwyg();

        elements.forEach((element) => {

            // Prevent duplicate initialization.
            if (element.dataset.markdownInitialized === 'true') {
                return;
            }

            const inputId = element.dataset.input;

            const input = document.getElementById(inputId);

            if (!input) {
                console.error(
                    `Markdown editor input #${inputId} was not found.`
                );

                return;
            }

            const editor = new window.MarkdownWYSIWYG(
                element.id,
                {
                    initialValue: input.value || '',

                    onUpdate(markdownContent) {
                        input.value = markdownContent;
                    }
                }
            );

            // Keep a reference in case we need it later.
            element._markdownEditor = editor;

            element.dataset.markdownInitialized = 'true';
        });

    } catch (error) {

        console.error(
            'Markdown WYSIWYG initialization failed:',
            error
        );
    }
}