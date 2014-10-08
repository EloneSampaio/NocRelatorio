<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ZapFilmes
 *
 * @ORM\Table(name="zap_filmes")
 * @ORM\Entity
 */
class ZapFilmes
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="canal", type="string", length=45, nullable=false)
     */
    private $canal;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=15, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_exibir", type="string", length=45, nullable=true)
     */
    private $horaExibir;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;


}
