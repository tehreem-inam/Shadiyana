<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        rel="stylesheet"
        href="{{ asset('vendor/markdown-wysiwyg/editor.css') }}"
    >

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script src="{{ asset('vendor/markdown-wysiwyg/editor.js') }}"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen p-8">

        <h1 class="mb-8 text-4xl font-bold text-blue-600">
            Markdown Editor Test
        </h1>

        <div class="mx-auto max-w-4xl rounded-2xl bg-white p-6 shadow">

            <label class="mb-2 block text-sm font-bold text-gray-700">
                Test Markdown Editor
            </label>

            <div id="test-markdown-editor"></div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            if (typeof MarkdownWYSIWYG === 'undefined') {
                console.error('MarkdownWYSIWYG failed to load.');
                return;
            }

            const editor = new MarkdownWYSIWYG(
                'test-markdown-editor',
                {
                    initialValue: `# Wedding Photography

This is a **test** description.

## Our Services

- Wedding Photography
- Bridal Photography
- Event Photography
`
                }
            );

        });
    </script>

</body>
</html>