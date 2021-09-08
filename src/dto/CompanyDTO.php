<?php
class CompanyDTO
{
    private $id;
    private $name;
    private $email;
    private $address;
    private $document_number;
    private $participants_number;
    private $id_document_type;
    private $activity;
    private $billing;
    private $id_country;
    private $total;
    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDocumentNumber()
    {
        return $this->document_number;
    }

    /**
     * @param mixed $document_number
     */
    public function setDocumentNumber($document_number)
    {
        $this->document_number = $document_number;
    }

    /**
     * @return mixed
     */
    public function getParticipantsNumber()
    {
        return $this->participants_number;
    }

    /**
     * @param mixed $phone_numer
     */
    public function setParticipantsNumber(int $participants_number)
    {
        $this->participants_number = $participants_number;
    }

    /**
     * @return mixed
     */
    public function getIdDocumentType()
    {
        return $this->id_document_type;
    }

    /**
     * @param mixed $id_document_type
     */
    public function setIdDocumentType($id_document_type)
    {
        $this->id_document_type = $id_document_type;
    }

    /**
     * @return mixed
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param mixed $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return mixed
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * @param mixed $billing
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;
    }

    /**
     * @return mixed
     */
    public function getIdCountry()
    {
        return $this->id_country;
    }

    /**
     * @param mixed $id_person_type
     */
    public function setIdCountry($id_country)
    {
        $this->id_country = $id_country;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

}
