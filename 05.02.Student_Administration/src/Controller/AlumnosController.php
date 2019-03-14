<?php

namespace App\Controller;

use App\Entity\Alumnos;
use App\Form\AlumnosType;
use App\Repository\AlumnosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/alumnos")
 */
class AlumnosController extends AbstractController
{
    /**
     * @Route("/", name="alumnos_index", methods={"GET"})
     */
    public function index(AlumnosRepository $alumnosRepository): Response
    {
        return $this->render('alumnos/index.html.twig', [
            'alumnos' => $alumnosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="alumnos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $alumno = new Alumnos();
        $form = $this->createForm(AlumnosType::class, $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alumno);
            $entityManager->flush();

            return $this->redirectToRoute('alumnos_index');
        }

        return $this->render('alumnos/new.html.twig', [
            'alumno' => $alumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="alumnos_show", methods={"GET"})
     */
    public function show(Alumnos $alumno): Response
    {
        return $this->render('alumnos/show.html.twig', [
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="alumnos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Alumnos $alumno): Response
    {
        $form = $this->createForm(AlumnosType::class, $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumnos_index', [
                'id' => $alumno->getId(),
            ]);
        }

        return $this->render('alumnos/edit.html.twig', [
            'alumno' => $alumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="alumnos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Alumnos $alumno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alumno->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($alumno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('alumnos_index');
    }
}
