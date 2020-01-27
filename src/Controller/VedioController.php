<?php

namespace App\Controller;

use App\Entity\Vedio;
use App\Form\VedioEditType;
use App\Form\VedioType;
use App\Repository\VedioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @Route("/admin")
 */
class VedioController extends AbstractController
{
    /**
     * @Route("/vedio", name="vedio_index", methods={"GET"})
     */
    public function index(VedioRepository $vedioRepository,ObjectManager $manger): Response
    {
        $contact = $manger->createQuery(" SELECT count(c) FROM App\Entity\Contact c WHERE c.valide = false ")->getSingleScalarResult();
        
        return $this->render('admin/vedio/index.html.twig', [
            'vedios' => $vedioRepository->findAll(),
            'stats'  => compact('contact')
        ]);
    }



    /**
     * @Route("/vedio/{id}", name="vedio_show", methods={"GET"})
     */
    public function show(Vedio $vedio,ObjectManager $manger): Response
    {
        $contact = $manger->createQuery(" SELECT count(c) FROM App\Entity\Contact c WHERE c.valide = false ")->getSingleScalarResult();
        
        return $this->render('admin/vedio/show.html.twig', [
            'vedio' => $vedio,
            'stats'  => compact('contact')
        ]);
    }

    /**
     * @Route("/vedio/{id}/edit", name="vedio_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vedio $vedio): Response
    {
        $form = $this->createForm(VedioEditType::class, $vedio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $vedio->setAuthor($this->getUser());
            $type = $request->get("typeName");
            $vedio->setType($type);
            $entityManager->persist($vedio);
            $entityManager->flush();
            return $this->redirectToRoute('vedio_index');
        }


        return $this->render('admin/vedio/edit.html.twig', [
            'vedio' => $vedio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/vedio/{id}", name="vedio_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vedio $vedio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vedio->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vedio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vedio_index');
    }
}
