<style>
    .text-center {
        text-align: center;
    }
</style>


<h3 class="text-center">You have a New Contact via Contact Form</h3>

<p class="text-center">{{ $subject }}</p>

<div class="text-center">
    {{ $messageBody }}
</div>

<p class="text-center">
    Sent via {{ $email }}
</p>