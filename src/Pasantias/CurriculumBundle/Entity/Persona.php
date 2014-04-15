<?php

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description of Persona
 *
 * @author matias
 */
/**
 * Pasantias\CurriculumBundle\Entity\Persona
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="personas")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="dni",message="Ya existe un curriculum con este DNI.")
 */
class Persona {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $nombre;

    /** @ORM\Column(type="string", length=100) */
    private $apellido;

    /** @ORM\Column(type="string", length=1) */
    private $sexo;

    /** @ORM\Column(type="string", length=10, unique=true) */
    private $dni;

    /** @ORM\Column(type="string", length=13) */
    private $cuit;

    /** @ORM\Column(name="fecha_nacimiento",type="date") */
    private $fechaNacimiento;

    /** @ORM\OneToMany(targetEntity="Pasantias\CurriculumBundle\Entity\Domicilio", mappedBy="personas", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $domicilio;

    /** @ORM\Column(type="string", length=100) */
    private $telefono;

    /** @ORM\OneToMany(targetEntity="Pasantias\CurriculumBundle\Entity\FormacionAcademica", mappedBy="personas", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $formacionAcademica;

    /** @ORM\OneToMany(targetEntity="Pasantias\CurriculumBundle\Entity\Conocimientos", mappedBy="personas", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $conocimientos;

    /** @ORM\OneToMany(targetEntity="Pasantias\CurriculumBundle\Entity\AntecedenteLaboral", mappedBy="personas", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $antecedenteLaboral;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\OneToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Curriculum",mappedBy="persona")
     * @ORM\JoinColumn(name="curriculum_id", referencedColumnName="id")
     */
    protected $curriculum;

    /**
     * @ORM\OneToOne(targetEntity="Pasantias\UsuariosBundle\Entity\Usuarios", mappedBy="persona")
     */
    private $usuario;

    /** @ORM\OneToMany(targetEntity="Pasantias\EmpresasBundle\Entity\Postulaciones", mappedBy="persona", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $postulaciones;

    /** @ORM\OneToMany(targetEntity="Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundaria", mappedBy="personas", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $formacionAcademicaSecundaria;
    
    /** @ORM\OneToMany(targetEntity="Pasantias\EmpresasBundle\Entity\SolicitudesNuevas", mappedBy="persona")      
     */
    private $solicitudNueva;
    
    

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'foto_perfil';
    }

    /**
     * @Assert\File(maxSize="6000000",
     *      mimeTypes = {"image/*"},
     *     mimeTypesMessage = "Solo se admiten imágenes"
     * )
     */
    private $file;
    private $temp;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // haz lo que quieras para generar un nombre único
            //$filename = sha1(uniqid(mt_rand(), true));
            $filename = $this->dni;
            $this->path = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    public function __toString() {
        return $this->apellido . " " . $this->nombre;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }

        // si hay un error al mover el archivo, move() automáticamente
        // envía una excepción. This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function setFormacionAcademica($formacionAcademica) {
        $this->formacionAcademica = $formacionAcademica;
    }

    public function setFormacionAcademicaSecundaria($formacionAcademicaSecundaria) {
        $this->formacionAcademicaSecundaria = $formacionAcademicaSecundaria;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->domicilio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formacionAcademica = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conocimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->antecedenteLaboral = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postulaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formacionAcademicaSecundaria = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Persona
     */
    public function setApellido($apellido) {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Persona
     */
    public function setSexo($sexo) {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo() {
        return $this->sexo;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Persona
     */
    public function setDni($dni) {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni() {
        return $this->dni;
    }

    /**
     * Set cuit
     *
     * @param string $cuit
     * @return Persona
     */
    public function setCuit($cuit) {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string 
     */
    public function getCuit() {
        return $this->cuit;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Persona
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Persona
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Add domicilio
     *
     * @param \Pasantias\CurriculumBundle\Entity\Domicilio $domicilio
     * @return Persona
     */
    public function addDomicilio(\Pasantias\CurriculumBundle\Entity\Domicilio $domicilio) {
        $this->domicilio[] = $domicilio;

        return $this;
    }

    /**
     * Remove domicilio
     *
     * @param \Pasantias\CurriculumBundle\Entity\Domicilio $domicilio
     */
    public function removeDomicilio(\Pasantias\CurriculumBundle\Entity\Domicilio $domicilio) {
        $this->domicilio->removeElement($domicilio);
    }

    /**
     * Get domicilio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDomicilio() {
        return $this->domicilio;
    }

    /**
     * Add formacionAcademica
     *
     * @param \Pasantias\CurriculumBundle\Entity\FormacionAcademica $formacionAcademica
     * @return Persona
     */
    public function addFormacionAcademica(\Pasantias\CurriculumBundle\Entity\FormacionAcademica $formacionAcademica) {
        $this->formacionAcademica[] = $formacionAcademica;

        return $this;
    }

    /**
     * Remove formacionAcademica
     *
     * @param \Pasantias\CurriculumBundle\Entity\FormacionAcademica $formacionAcademica
     */
    public function removeFormacionAcademica(\Pasantias\CurriculumBundle\Entity\FormacionAcademica $formacionAcademica) {
        $this->formacionAcademica->removeElement($formacionAcademica);
    }

    /**
     * Get formacionAcademica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormacionAcademica() {
        return $this->formacionAcademica;
    }

    /**
     * Add conocimientos
     *
     * @param \Pasantias\CurriculumBundle\Entity\Conocimientos $conocimientos
     * @return Persona
     */
    public function addConocimiento(\Pasantias\CurriculumBundle\Entity\Conocimientos $conocimientos) {
        $this->conocimientos[] = $conocimientos;

        return $this;
    }

    /**
     * Remove conocimientos
     *
     * @param \Pasantias\CurriculumBundle\Entity\Conocimientos $conocimientos
     */
    public function removeConocimiento(\Pasantias\CurriculumBundle\Entity\Conocimientos $conocimientos) {
        $this->conocimientos->removeElement($conocimientos);
    }

    /**
     * Get conocimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConocimientos() {
        return $this->conocimientos;
    }

    /**
     * Add antecedenteLaboral
     *
     * @param \Pasantias\CurriculumBundle\Entity\AntecedenteLaboral $antecedenteLaboral
     * @return Persona
     */
    public function addAntecedenteLaboral(\Pasantias\CurriculumBundle\Entity\AntecedenteLaboral $antecedenteLaboral) {
        $this->antecedenteLaboral[] = $antecedenteLaboral;

        return $this;
    }

    /**
     * Remove antecedenteLaboral
     *
     * @param \Pasantias\CurriculumBundle\Entity\AntecedenteLaboral $antecedenteLaboral
     */
    public function removeAntecedenteLaboral(\Pasantias\CurriculumBundle\Entity\AntecedenteLaboral $antecedenteLaboral) {
        $this->antecedenteLaboral->removeElement($antecedenteLaboral);
    }

    /**
     * Get antecedenteLaboral
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAntecedenteLaboral() {
        return $this->antecedenteLaboral;
    }

    /**
     * Set curriculum
     *
     * @param \Pasantias\CurriculumBundle\Entity\Curriculum $curriculum
     * @return Persona
     */
    public function setCurriculum(\Pasantias\CurriculumBundle\Entity\Curriculum $curriculum = null) {
        $this->curriculum = $curriculum;

        return $this;
    }

    /**
     * Get curriculum
     *
     * @return \Pasantias\CurriculumBundle\Entity\Curriculum 
     */
    public function getCurriculum() {
        return $this->curriculum;
    }

    /**
     * Set usuario
     *
     * @param \Pasantias\UsuariosBundle\Entity\Usuarios $usuario
     * @return Persona
     */
    public function setUsuario(\Pasantias\UsuariosBundle\Entity\Usuarios $usuario = null) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Pasantias\UsuariosBundle\Entity\Usuarios 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Add postulaciones
     *
     * @param \Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones
     * @return Persona
     */
    public function addPostulacione(\Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones) {
        $this->postulaciones[] = $postulaciones;

        return $this;
    }

    /**
     * Remove postulaciones
     *
     * @param \Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones
     */
    public function removePostulacione(\Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones) {
        $this->postulaciones->removeElement($postulaciones);
    }

    /**
     * Get postulaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulaciones() {
        return $this->postulaciones;
    }

    /**
     * Add formacionAcademicaSecundaria
     *
     * @param \Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundaria $formacionAcademicaSecundaria
     * @return Persona
     */
    public function addFormacionAcademicaSecundaria(\Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundaria $formacionAcademicaSecundaria) {
        $this->formacionAcademicaSecundaria[] = $formacionAcademicaSecundaria;

        return $this;
    }

    /**
     * Remove formacionAcademicaSecundaria
     *
     * @param \Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundaria $formacionAcademicaSecundaria
     */
    public function removeFormacionAcademicaSecundaria(\Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundaria $formacionAcademicaSecundaria) {
        $this->formacionAcademicaSecundaria->removeElement($formacionAcademicaSecundaria);
    }

    /**
     * Get formacionAcademicaSecundaria
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormacionAcademicaSecundaria() {
        return $this->formacionAcademicaSecundaria;
    }


    /**
     * Add solicitudNueva
     *
     * @param \Pasantias\EmpresasBundle\Entity\SolicitudesNuevas $solicitudNueva
     * @return Persona
     */
    public function addSolicitudNueva(\Pasantias\EmpresasBundle\Entity\SolicitudesNuevas $solicitudNueva)
    {
        $this->solicitudNueva[] = $solicitudNueva;
    
        return $this;
    }

    /**
     * Remove solicitudNueva
     *
     * @param \Pasantias\EmpresasBundle\Entity\SolicitudesNuevas $solicitudNueva
     */
    public function removeSolicitudNueva(\Pasantias\EmpresasBundle\Entity\SolicitudesNuevas $solicitudNueva)
    {
        $this->solicitudNueva->removeElement($solicitudNueva);
    }

    /**
     * Get solicitudNueva
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudNueva()
    {
        return $this->solicitudNueva;
    }
}