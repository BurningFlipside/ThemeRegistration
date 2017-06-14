<?php
class RegistrationAPI extends Http\Rest\DataTableAPI
{
    public function __construct()
    {
        parent::__construct('registration', 'themes', '_id');
    }

    public function set($app)
    {
        parent::setup($app);
    }

    protected function processEntry($obj, $request)
    {
        foreach($obj as $key=>$value)
        {
            if($key == '_id')
            {
                $obj['_id'] = (string)$obj['_id'];
            }
            else if(is_object($value) || is_array($value))
            {
                if($key === 'value') continue;
                if(!$this->user->isInGroupNamed('ThemeAdmins'))
                {
                    unset($obj[$key]);
                }
            }
        }
        return $obj;
    }

    protected function canCreate($request)
    {
        $this->validateLoggedIn($request);
        return true;
    }

    protected function canUpdate($request, $entity)
    {
        $this->validateLoggedIn($request);
        if($this->user->isInGroupNamed('ThemeAdmins'))
        {
            return true;
        }
        return in_array($this->user->uid, $entity['registrars']);
    }

    protected function canDelete($request, $entity)
    {
        $this->validateLoggedIn($request);
        if($this->user->isInGroupNamed('ThemeAdmins'))
        {
            return true;
        }
        return in_array($this->user->uid, $entity['registrars']);
    }

    protected function getFilterForPrimaryKey($value)
    {
        return new \Data\Filter($this->primaryKeyName.' eq '.new MongoId($value));
    }

    protected function getCurrentYear()
    {
        $varsDataTable = \DataSetFactory::getDataTableByNames($this->dataSetName, 'vars');
        $arr = $varsDataTable->read(new \Data\Filter("name eq 'year'"));
        return intval($arr[0]['value']);
    }

    protected function manipulateParameters($request, &$odata)
    {
        $queryParams = $request->getQueryParams();
        if(!$this->user->isInGroupNamed('ThemeAdmins') || $odata->filter === false)
        {
            $odata->filter = new \Data\Filter('year eq '.$this->getCurrentYear());
        }
        if(isset($queryParams['no_logo']))
        {
            return array('fields'=>array('logo' => false, 'image' => false));
        }
        return false;
    }

    protected function validateCreate(&$obj, $request)
    {
        if(!isset($obj['name']))
        {
            throw new Exception('Missing one or more required parameters!', \Http\Rest\INTERNAL_ERROR);
        }
        $obj['year'] = $this->getCurrentYear();
        if(!isset($obj['registrars']))
        {
            $obj['registrars'] = array();
        }
        if(!in_array($app->user->uid, $obj['registrars']))
        {
            array_push($obj['registrars'], $app->user->uid);
        }
        return true;
    }

    protected function validateUpdate(&$newObj, $request, $oldObj)
    {
        if(!isset($obj['name']))
        {
            throw new Exception('Missing one or more required parameters!', \Http\Rest\INTERNAL_ERROR);
        }
        $obj['year'] = $this->getCurrentYear();
        if(!isset($obj['registrars']))
        {
            $obj['registrars'] = array();
        }
        $obj['registrars'] = array_merge($obj['registrars'], $oldObj['registrars']);
        if($this->user->isInGroupNamed('ThemeAdmins'))
        {
            array_push($obj['registrars'], $this->user->uid);
        }
        $obj['registrars'] = array_unique($obj['registrars']);
        if(!isset($obj['_id']))
        {
             $obj['_id'] = (string)$oldObj['_id'];
        }
    }
}
/* vim: set tabstop=4 shiftwidth=4 expandtab: */
