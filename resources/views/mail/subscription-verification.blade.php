<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>

    <p> Hello there! </p>

    <p>Welcome to ArtNexus – where art meets passion and creativity knows no bounds! </p>

    <p>We're thrilled to have you join our vibrant community of artists and art enthusiasts. Your subscription opens the door to a world of inspiration, innovation, and endless possibilities. </p>
    <p>But first, let's make it official! </p>
    <p>Please take a moment to verify your subscription by clicking the magical link below: </p>

    <a href="{{route('newsletter-verify', $subscriber->verified_token)}}">Click here</a>

    <p>Once you've done that, you're officially part of the ArtNexus family! Get ready to dive into a kaleidoscope of artistic wonders, discover new talents, and be captivated by the beauty of creativity. </p>
    <p>Thank you for embarking on this artistic journey with us. Together, let's paint the world with imagination and passion! </p>
    <br>

    <p>With boundless creativity, </p>
    <p>The ArtNexus Team </p>

</body>
</html>
