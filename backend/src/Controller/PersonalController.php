<?php

namespace App\Controller;

use App\Entity\Personal;
use App\Form\PersonalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/apis")
 */
class PersonalController extends AbstractController
{
    /**
     * @Route("/personal", name="personal_index", methods={"GET"})
     */
    public function index(SerializerInterface $serializer)
    {
        $personals = $this->getDoctrine()
            ->getRepository(Personal::class)
            ->findAll();
        return $this->json($personals);
    }

    /**
     * @Route("/personal", name="personal_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $json = $request->get("json", null);

        if ($json != null) {
            $params = json_decode($json);
            $name = $params->name;
            $lastname = $params->lastname;
            $email = $params->email;
            $ci = $params->ci;

            $user = new Personal();
            $user->setName($name);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setCi($ci);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json([
                'status' => 'sucess', 'data' => 'Usuario creado'
            ]);
        } else {
            return $this->json([
                'message' => 'Datos incorrectos'
            ]);
        }
    }

    /**
     * @Route("/personal/{id}", name="personal_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        //$id=1;
        $id = $request->get("id");
        $personals = $this->getDoctrine()
            ->getRepository(Personal::class)
            ->findById($id);
        return $this->json($personals);
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
     * @Route("/personal/{id}", name="personal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personal $personal): Response
    {
        //$id=1;
        $id = $request->get("id");
        $personals = $this->getDoctrine()
            ->getRepository(Personal::class)
            ->findById($id);
        //return $this->json($personals);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($personal);
        $entityManager->flush();

        return $this->json([
            'status' => 'sucess', 'data' => 'Usuario Borrado'
        ]);
    }
}
