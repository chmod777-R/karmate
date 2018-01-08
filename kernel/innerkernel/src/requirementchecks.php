<?php
namespace Karmate\Kernel\InnerKernel\Src;

class RequirementChecks
{
	/**
    * Array
    * It records the php version with all its parameters.
    */
	public $version 			=	 null;

	/**
    * INT
    * Required PHP VERSION
    */
	private $requiredVersion 	=	 '7';

    /**
    * Run function
    * Runs some functions
    */
    public function run()
    {
		#RUN -> phpVersionAssign
		self::phpVersionAssign();

		#RUN -> phpVersionControl
		self::phpVersionControl();

		#RUN-> setApacheRequirements
		self::setApacheRequirements(__DIR__.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR, 'apacherequirements.php');

    }

    /**
    * PHP Version Assign function
    * This function transfers to the version object.
    */
    private function phpVersionAssign()
    {
        $this->version = explode('.', phpversion());
    }

	/**
    * PHP Version Control function
    * This function checks whether the system provides the required version.
    */
    private function phpVersionControl()
    {
        if ($this->version['0'] < $this->requiredVersion)
		{
			#STYLE
			echo'<link rel="stylesheet" href="kernel/innerkernel/style/requirements_table.css" />';
			#TABLE
			echo '<table class="gridtable">
				  <tr>
				  <th colspan="5">
				  PHP <span class="requiredVersion"> under '.$this->requiredVersion.' </span> is not supported. Please update your PHP version to <span class="requiredVersion"> PHP: '.$this->requiredVersion.'</span>
				  </th>
				  </tr>
				  </table>';
        	die;
        }
    }

	/**
    * Set apache requirements function
    * Sets KARMATE's apache requitments
    */
	public function setApacheRequirements($confDir, $requirementsFile)
	{
		$requirements = (require $confDir.$requirementsFile);
		#RUN-> sendApacheRequirementsControl()
		$modRewrite = self::sendApacheRequirementsControl($requirements);
	}

	/**
    * Send Apache Requirements Control function
    * Sends requirements to apacheRequirements()
    */
	private function sendApacheRequirementsControl($requirements)
	{
		$status = array();
		$i 		= 0;

		foreach ($requirements as $requirement) {
			if($i >= 1) $status["$requirement"] = ',';
			$status["$requirement"] .= ''.self::apacheModulesControl($requirement);
			$i++;
		}

		#RUN -> apacheRequirements
		self::apacheRequirements($requirements, $status);

	}

	/**
    * Apache Modules Control function
    * Control Apache modules. If there are no requirements, it appeals.
    */
    private function apacheModulesControl($module)
    {
		$result = in_array($module, apache_get_modules());
		if($result != '1') $result = '0';
        return $result;
    }

	/**
    * Apache Requirements function
    * It continues if the requirements are met, and appeals if it is not.
    */
    private function apacheRequirements($requirements = null, $status = null)
    {
		if(in_array(',0', $status) or in_array('0', $status)) {
			$thisModuleRequired = '<span class="requiredModules"><b>0</b></span>';

			#STYLE
			echo'<link rel="stylesheet" href="kernel/innerkernel/style/requirements_table.css" />';

			#TABLE
			echo '<table class="gridtable">
				  <tr>
				  <th colspan="5">
				  The missing apache modules are marked with "'.$thisModuleRequired.'".<br>
				  Please contact your server administrator
				  </th>
				  </tr>
				  <tr>';
				  foreach ($requirements as $key) {
				  echo '<th>'.$key.'</th>';
				  }
		     echo'
				  </tr>
				  <tr>';
				  foreach ($requirements as $key) {
				  $status[$key] = str_replace(',', null, $status[$key]);
				  if($status[$key] == 0) $status[$key] = $thisModuleRequired;
				  echo '<td>'.$status[$key].'</td>';
				  }
		     echo'
				  </tr>
				  </table>';
				  die;
		}
    }
}
