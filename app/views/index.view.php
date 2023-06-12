<?php require('partials/head.view.php'); ?>

<div x-data="{open:false}" class="max-w-screen-lg mx-auto">
    <h1>Home Page</h1>
    <button @click="open = !open" class="bg-blue-500 px-4 py-1.5">Open Modal</button>
    <div x-show="open" class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50">
        <div class="p-8 bg-white rounded-lg" @click.outside="open=false">
            <h2>Modal Title</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
            <button class="text-xs bg-gray-300" @click="open = false">Close</button>
        </div>
    </div>

</div>

<?php require('partials/footer.view.php'); ?>
