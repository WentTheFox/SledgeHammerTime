<?php

namespace App\Http\Middleware;

use App\Enums\RouteName;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class RemoveUselessQueryParams {
  /**
   * Handle an incoming request.
   *
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    if ($request->isMethod(Request::METHOD_GET)){
      $queryParamsInput = $request->query->all();
      $queryParamsOutput = [];
      if ($request->route()->getName() === RouteName::HOME->value){
        $this->appendQueryParamIfExists($queryParamsInput, 't', $queryParamsOutput);
        $this->appendQueryParamIfExists($queryParamsInput, 'tz', $queryParamsOutput);
      }

      if ($this->shouldRedirect($queryParamsInput, $queryParamsOutput)){
        $queryString = count($queryParamsOutput) > 0 ? '?'.Arr::query($queryParamsOutput) : '';
        return redirect($request->path().$queryString);
      }
    }

    return $next($request);
  }

  /**
   * @param array<string,string>  $queryParamsInput
   * @param string $paramName
   * @param array<string,string>  $queryParamsOutput
   *
   * @return void
   */
  protected function appendQueryParamIfExists(array $queryParamsInput, string $paramName, array &$queryParamsOutput):void {
    if (array_key_exists($paramName, $queryParamsInput)){
      $queryParamsOutput[$paramName] = $queryParamsInput[$paramName];
    }
  }

  /**
   * @param array<string,string> $queryParamsOutput
   * @param array<string,string> $queryParamsInput
   *
   * @return bool
   */
  protected function shouldRedirect(array $queryParamsInput, array $queryParamsOutput):bool {
    $redirect = count($queryParamsInput) !== count($queryParamsOutput);
    if (!$redirect){
      foreach (array_keys($queryParamsOutput) as $k){
        if ($queryParamsInput[$k] !== $queryParamsOutput[$k]){
          $redirect = true;
          break;
        }
      }
    }

    return $redirect;
  }
}
