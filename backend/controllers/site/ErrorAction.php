<?php
namespace backend\controllers\site;

use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * Renders a view that represents the exception.
     * @return string
     * @since 2.0.11
     */
    protected function renderHtmlResponse()
    {
        $ex = $this->findException();
        if ($ex instanceof ForbiddenHttpException) {
            return $this->controller->render('/site/error_403' ?: $this->id, $this->getViewRenderParams());
        } elseif ($ex instanceof NotFoundHttpException) {
            return $this->controller->render('/site/error_404' ?: $this->id, $this->getViewRenderParams());
        }
        else return $this->controller->render('/site/error' ?: $this->id, $this->getViewRenderParams());
    }
}