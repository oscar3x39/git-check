<?php

class gitcheck
{
	function __construct()
	{
		$this->config = yaml_parse_file('config.yml');
	}

	function repo_list()
	{
		return $this->config['repo'];
	}

	function repo_clone($name, $url)
	{
		echo "ready to clone $url";
		exec("cd project && git clone $url $name", $result);
		echo "finish to clone $url";
		return $result;
	}

	function repo_exists($name)
	{
		return is_dir('project/'.$name) ? true : false;
	}

	function repo_switch_branch($name, $branch)
	{
		exec("cd project/$name && git checkout $branch", $result);
		return $result;
	}

	function get_fix_commit($name, $branch, $rule)
	{
		$this->repo_switch_branch($name, $branch);
		exec("cd project/$name && git log --pretty='%h - %s' | grep '$rule'", $result);
		return $result;
	}

	function get_history_commit($name, $branch)
	{
		$this->repo_switch_branch($name, $branch);
		exec("cd project/$name && git log --pretty='%h - %s'", $result);
		return $result;
	}

	function get_current_branch($name, $branch)
	{
		exec("cd project/$name && git branch | grep \* | cut -d ' ' -f2", $result);
		$result = isset($result[0]) ? $result[0] : "";
		return $result;
	}

	function check_branch_fix($name, $watch, $fix_commit)
	{
		if (!is_array($watch)) {
			return false;
		}

		$result = [];
		foreach ($watch as $branch_name) {
			$history_commit = $this->get_history_commit($name, $branch_name);
			$result[$branch_name] = array_diff($fix_commit, $history_commit);
		}

		return $result;
	}

	function display($name, $message, $type = 'command')
	{
		foreach ($message as $branch_name => $commit) {
			echo "-----------------------------".PHP_EOL;
			echo "Project: $name".PHP_EOL;
			echo "Branch: $branch_name".PHP_EOL;
			foreach ($commit as $no => $value) {
				$no++;
				echo "commit-$no: $value".PHP_EOL;
			}
		}
	}
}
