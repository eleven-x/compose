
# Compose

 Compose middleware.

## Install 

`composer require eleven-x/compose`

## API

### compose([a, b, c, ...])

  Compose the given middleware and return middleware.



## Demo

```php
    
    $fn = compose([
        function($request,$next){
            // TODO before next
            $request[] = 1;
            $response = $next($request);
            $response[] = 1;
            // TODO after next
            return $response;
        },
        function($request,$next){
            // TODO before next
            $request[] = 2;
            $response = $next($request);
            // TODO after next
            $response[] = 2;
            return $response;
        },
        function($request){
            print_r($request); // // will printout [1,2]
            $response = [];
            return $response;
        },
    ]);
    $request = [];
    $response = $fn($request);
    print_r($response); // will printout [2,1]

```

## License

  MIT