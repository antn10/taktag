<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="text.css">
</head>
<body>
    <div class="container">
        <span class="text first-text">Cómo conectar </span>
        <span class="text sec-text">teléfono con computadora</span>
    </div>
    <script>
        const text = document.querySelector(".sec-text");
        const textLoad = () => {
            setTimeout(() => {text.textContent = "computadora con tv";}, 0);
            setTimeout(() => {text.textContent = "televisor con equipo de audio";   }, 4000);
            setTimeout(() => {text.textContent = "celular con parlante";  }, 8000); //1s = 1000 milliseconds
        }
        textLoad();setInterval(textLoad, 12000);
    </script>    
</body>
</html>
