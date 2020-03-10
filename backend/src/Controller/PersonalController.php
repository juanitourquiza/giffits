<?php

namespace App\Controller;

use App\Entity\Personal;
use App\Form\PersonalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personal")
 */
class PersonalController extends AbstractController
{
    /**
     * @Route("/", name="personal_index", methods={"GET"})
     */
    public function index(): Response
    {
        $personals = $this->getDoctrine()
            ->getRepository(Personal::class)
            ->findAll();

        return $this->render('personal/index.html.twig', [
            'personals' => $personals,
        ]);
    }

    /**
     * @Route("/new", name="personal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personal = new Personal();
        $form = $this->createForm(PersonalType::class, $personal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personal);
            $entityManager->flush();

            return $this->redirectToRoute('personal_index');
        }

        return $this->render('personal/new.html.twig', [
            'personal' => $personal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personal_show", methods={"GET"})
     */
    public function show(Personal $personal): Response
    {
        return $this->render('personal/show.html.twig', [
            'personal' => $personal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personal $personal): Response
    {
        $form = $this->createForm(PersonalType::class, $personal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personal_index');
        }

        return $this->render('personal/edit.html.twig', [
            'personal' => $personal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personal $personal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personal_index');
    }
}
