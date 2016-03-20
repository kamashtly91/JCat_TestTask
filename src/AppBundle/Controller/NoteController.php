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
     * @return string
     * @Method("GET")
     * @Route(
     *     "/list/{page}/{count}/{order}",
     *     defaults={"page": 1, "count": 10, "order": "asc"},
     *     requirements={
     *          "page": "[1-9]\d*",
     *          "count": "[1-9]\d*",
     *          "order": "(ASC|asc|DESC|desc)"
     *     }, name="note_list")
     */
    public function listAction($page, $count, $order)
    {
        /** @var \AppBundle\Repository\Note $noteRepository */
        $noteRepository = $this->getDoctrine()->getRepository('AppBundle:Note');
        $news = $noteRepository->getIntervalNews(($page - 1) * $count, $count, $order);
        return new Response(json_encode(['news' => $news, 'count' => $noteRepository->countNews()]));

    }

    /**
     * @param $id
     * @return mixed
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
        return new Response(json_encode($note));
    }
}