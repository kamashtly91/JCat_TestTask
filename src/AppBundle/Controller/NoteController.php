<?php
/**
 * Created by PhpStorm.
 * User: helen
 * Date: 19/03/16
 * Time: 15:07
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class NoteController
 * @package AppBundle\Controller
 */
class NoteController extends Controller
{

    /**
     * @param $page
     * @param $count
     * @param $order
     * @return Response
     * @Method("GET")
     * @Route(
     *     "/news/{page}/{count}/{order}",
     *     defaults={"page": 1, "count": 10, "orderColumn": "publish_date_time", "order": "asc"},
     *     requirements={
     *          "page": "[1-9]\d*",
     *          "count": "[1-9]\d*",
     *          "orderColumn": "title|publish_date_time",
     *          "order": "(ASC|asc|DESC|desc)"
     *     }, name="note_list")
     */
    public function listAction($page, $count,$orderColumn, $order)
    {
        var_dump($count);
        /** @var \AppBundle\Repository\Note $noteRepository */
        $noteRepository = $this->getDoctrine()->getRepository('AppBundle:Note');
        $news = $noteRepository->getIntervalNews(($page - 1) * $count, $count, $orderColumn, $order);
        return new Response(json_encode(['news' => $news, 'count' => $noteRepository->countNews()]));

    }

    /**
     * @param $id
     * @return Response
     * @Method("GET")
     * @Route(
     *     "/view/{id}",
     *     requirements={
     *          "page": "[1-9]\d*",
     *     }, name="note_view")
     */
    public function viewAction($id)
    {
        /** @var \AppBundle\Repository\Note $noteRepository */
        $noteRepository = $this->getDoctrine()->getRepository('AppBundle:Note');
        $note = $noteRepository->getItemById($id);
        if(!$note){
            throw new NotFoundHttpException('Note not found!');
        }
        return new Response(json_encode($note));
    }
}