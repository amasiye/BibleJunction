<?php
/**
 * The base controller class.
 */
class Controller
{

  /**
   * Constructs a new model by the given model name.
   * @param $model The name of the model to construct.
   * @return $model The newly constructed model object.
   */
  public function model($model)
  {
    global $locale;

    if(file_exists('app/' . $locale . '/models/' . $model . '.php'))
      require_once 'app/' . $locale . '/models/' . $model . '.php';

    return new $model();
  }

  /**
   * Constructs a new view by the given view name.
   * @param $view The name of the view to construct.
   * @param $data An array of extra data to pass to the view upon updating it.
   */
  public function view($view, $data = array())
  {
    global $locale;

    if(file_exists('app/' . $locale . '/views/' . $view . '.php'))
      require_once 'app/' . $locale . '/views/' . $view . '.php';

    // return new $view();
  }
}

?>
