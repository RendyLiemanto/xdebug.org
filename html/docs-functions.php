<?php $title = "Xdebug: Documentation - Functions"; include "include/header.php"; hits ('xdebug-docs-functions'); ?>
		<tr>
			<td>&nbsp;</td>
			<td><span class="serif">
			
<!-- MAIN FEATURE START -->

<span class="sans">XDEBUG EXTENSION FOR PHP | DOCUMENTATION - FUNCTION REFERENCE</span><br />

<?php include "include/menu-docs.php"; ?>

<span class="sans"><a href="#stack">ACTIVATION RELATED FUNCTIONS</a></span>
<dl class="functionlist">
<dt><a href="#xdebug_disable">xdebug_disable()</a></dt>
<dd>disables displaying stacktraces on errors</dd>

<dt><a href="#xdebug_enable">xdebug_enable()</a></dt>
<dd>enables displaying stacktraces on errors</dd>

<dt><a href="#xdebug_is_enabled">xdebug_is_enabled()</a></dt>
<dd>returns whether stacktraces would be shown in case of errors</dd>

</dl>


<span class="sans"><a href="#stack">STACK RELATED FUNCTIONS</a></span>
<dl class="functionlist">
<dt><a href="#xdebug_call_class">xdebug_call_class()</a></dt>
<dd>returns the class from which the current function was called</dd>

<dt><a href="#xdebug_call_file">xdebug_call_file()</a></dt>
<dd>returns the file name from which the current function was called</dd>

<dt><a href="#xdebug_call_function">xdebug_call_function()</a></dt>
<dd>returns the function from which the current function was called</dd>

<dt><a href="#xdebug_call_line">xdebug_call_line()</a></dt>
<dd>returns the line number from which the current function was called</dd>

<dt><a href="#xdebug_get_function_stack">xdebug_get_function_stack()</a></dt>
<dd>returns an array representing the current stack</dd>

</dl>


<span class="sans"><a href="#tracing">EXECUTION RELATED FUNCTIONS</a></span>
<dl class="functionlist">
<dt><a href="#xdebug_dump_function_trace">xdebug_dump_function_trace()</a> [1]</dt>
<dd>displays all functions called since <a href='#xdebug_start_trace'>xdebug_start_trace()</a> as an HTML table</dd>

<dt><a href="#xdebug_get_function_trace">xdebug_get_function_trace()</a> [1]</dt>
<dd>returns all functions called since <a href='#xdebug_start_trace'>xdebug_start_trace()</a> as an array</dd>

<dt><a href="#xdebug_memory_usage">xdebug_memory_usage()</a></dt>
<dd>returns the current amount of script memory in use</dd>

<dt><a href="#xdebug_peak_memory_usage">xdebug_peak_memory_usage()</a> [2]</dt>
<dd>returns the maximum amount of memory used at one point</dd>

<dt><a href="#xdebug_start_trace">xdebug_start_trace()</a></dt>
<dd>starts tracing all function calls to a file</dd>

<dt><a href="#xdebug_stop_trace">xdebug_stop_trace()</a></dt>
<dd>stops tracing all function calls to a file</dd>

<dt><a href="#xdebug_time_index">xdebug_time_index()</a></dt>
<dd>returns the time since the start of the script</dd>

</dl>


<span class="sans"><a href="#coverage">CODE COVERAGE FUNCTIONS</a></span>
<dl class="functionlist">
<dt><a href="#xdebug_get_code_coverage">xdebug_get_code_coverage()</a></dt>
<dd>returns an array containing information on which lines are touched while executing the script</dd>

<dt><a href="#xdebug_start_code_coverage">xdebug_start_code_coverage()</a></dt>
<dd>starts collecting information on which lines are touched while executing the script</dd>

<dt><a href="#xdebug_stop_code_coverage">xdebug_stop_code_coverage()</a></dt>
<dd>stops collecting information on which lines are touched while executing the script</dd>

</dl>

<br /><br />

<a name="stack"></a>
<span class="sans">STACK RELATED</span><br />

<dl>
<a name='xdebug_get_function_stack'></a>
<dt>array xdebug_get_function_stack()</dt>
<dd>Returns an array which resembles the stack trace up to this point. The example script:
<pre class='example'><?php
$script = <<<SCRIPT
 1 <?php
 2     class strings {
 3         function fix_string(\$a)
 4         {
 5             var_dump (xdebug_get_function_stack());
 6         }
 7
 8         function fix_strings(\$b) {
 9             foreach (\$b as \$item) {
10                 \$this->fix_string(\$item);
11             }
12         }
13     }
14
15     \$s = new strings();
16     \$ret = \$s->fix_strings(array('Derick'));
17 ?>
SCRIPT;
highlight_string($script);
?></pre>
Returns:
<pre class='example'>
array(3) {
  [0]=&gt;
  array(4) {
    ["function"]=&gt;
    string(6) "{main}"
    ["file"]=&gt;
    string(38) "/home/httpd/html/test/xdebug_error.php"
    ["line"]=&gt;
    int(0)
    ["params"]=&gt;
    array(0) {
    }
  }
  [1]=&gt;
  array(5) {
    ["function"]=&gt;
    string(11) "fix_strings"
    ["class"]=&gt;
    string(7) "strings"
    ["file"]=&gt;
    string(38) "/home/httpd/html/test/xdebug_error.php"
    ["line"]=&gt;
    int(16)
    ["params"]=&gt;
    array(1) {
      [0]=&gt;
      string(21) "array (0 =&gt; 'Derick')"
    }
  }
  [2]=&gt;
  array(5) {
    ["function"]=&gt;
    string(10) "fix_string"
    ["class"]=&gt;
    string(7) "strings"
    ["file"]=&gt;
    string(38) "/home/httpd/html/test/xdebug_error.php"
    ["line"]=&gt;
    int(10)
    ["params"]=&gt;
    array(1) {
      [0]=&gt;
      string(8) "'Derick'"
    }
  }
}
</pre>
</dd>

<a name='xdebug_call_class'></a>
<a name='xdebug_call_function'></a>
<a name='xdebug_call_file'></a>
<a name='xdebug_call_line'></a>
<dt>string xdebug_call_class()<br />
string xdebug_call_function()<br />
string xdebug_call_file()<br />
int xdebug_call_line()</dt>
<dd>These four functions return information about the function that called the
current one, or FALSE when there was no previous function.  This example
script:
<pre class='example'><?php
$script = <<<SCRIPT
 1 <?php
 2     function fix_string(\$a)
 3     {
 4         echo "Called @ ".
 5             xdebug_call_file().
 6             ":".
 7             xdebug_call_line().
 8             " from ".
 9             xdebug_call_function();
10     }
11
12     \$ret = fix_string(array('Derick'));
13 ?>
SCRIPT;
highlight_string($script);
?>
</pre>
prints:
<pre class='example'>
Called @ /home/httpd/html/test/xdebug_caller.php:12 from {main}
</pre>
</dd>
</dl>

<br />
<a name="activation"></a>
<span class="sans">ACTIVATION RELATED</span><br />
<dl>
<a name='xdebug_enable'></a>
<dt>void xdebug_enable()</dt>
<dd>Enable showing stacktraces on error conditions.</dd>

<a name='xdebug_disable'></a>
<dt>void xdebug_disable()</dt>
<dd>Disable showing stacktraces on error conditions.</dd>

<a name='xdebug_is_enabled'></a>
<dt>bool xdebug_is_enabled()</dt>
<dd>Return whether stacktraces would be shown in case of an error or not.</dd>
</dl>


<br />
<a name="tracing"></a>
<span class="sans">TRACING AND EXECUTING RELATED</span><br />
<dl>
<a name='xdebug_start_trace'></a>
<dt>void xdebug_start_trace([string trace_file]) (Xdebug 1)</dt>
<dd>Start tracing function calls from this point. If the trace_file parameter
is specified the function calls will also be logged to this file. Please note
that all function calls are stored in memory here; with large scripts this will
definitely exhaust memory on your machine. In order for this functionality to
be useful it is strongly recommended to turn off the <a
href='docs-settings.php#collect_params'>xdebug.collect_params</a> setting.</dd>

<dt>void xdebug_start_trace(string trace_file [, integer options]) (Xdebug 2)</dt>
<dd>Start tracing function calls from this point to the file in the <i>trace_file</i> parameter.
The trace file will be placed in the directory as configured by the
<a href="docs-settings.php#trace_output_dir">trace_output_dir</a> setting.
The name of the trace file is "xdebug.{hash}.xt" where the "{hash}" part depends on the
<a href="docs-settings.php#trace_output_name">trace_output_name</a> setting. The <i>options</i>
parameter is a bitfield; currently only the option "XDEBUG_TRACE_APPEND" is available which 
will make the trace file open in append mode rather than overwrite mode. Unlike Xdebug 1, Xdebug 2
will not store function calls in memory, but always only write to disk to relieve the pressure
on used memory. The settings <a href='docs-settings.php#collect_includes'>collect_includes</a>, 
<a href='docs-settings.php#collect_params'>collect_params</a>
and <a href='docs-settings.php#collect_return'>collect_return</a> influence what information
is logged to the trace file.</dd>

<a name='xdebug_stop_trace'></a>
<dt>void xdebug_stop_trace() (Xdebug 1)</dt>
<dd>Stop tracing function calls and destroys the trace currently in memory.</dd>

<dt>void xdebug_stop_trace() (Xdebug 2)</dt>
<dd>Stop tracing function calls and destroys the trace currently in memory.</dd>

<a name='xdebug_get_function_trace'></a>
<dt>array xdebug_get_function_trace() (Xdebug 1)</dt>
<dd>Returns all function calls since <i>xdebug_start_trace()</i>. For the
following script:
<pre class='example'><?php
$script = <<<SCRIPT
 1 <?php
 2     xdebug_start_trace();
 3     function fix_string(\$a)
 4     {
 5         echo "Called @ ".
 6             xdebug_call_file().
 7             ":".
 8             xdebug_call_line().
 9             " from ".
10             xdebug_call_function();
11     }
12 
13     \$ret = fix_string(array('Derick'));
14     var_dump(xdebug_get_function_trace());
15 ?>
SCRIPT;
highlight_string($script);
?>
</pre>
returns an array in which each element represents one function call (much like
the stack trace) above. Each element contains the following information:
<pre class='example'>
  array(6) {
    ["function"]=&gt;
    string(10) "fix_string"
    ["file"]=&gt;
    string(39) "/home/httpd/html/test/xdebug_caller.php"
    ["line"]=&gt;
    int(13)
    ["time_index"]=&gt;
    float(0)
    ["memory_usage"]=&gt;
    int(37720)
    ["params"]=&gt;
    array(1) {
      [1]=&gt;
      string(21) "array (0 =&gt; 'Derick')"
    }
  }
</pre>
</dd>

<a name='dump_function_trace'></a>
<dt>void xdebug_dump_function_trace() (Xdebug 1)</dt>
<dd>If you don't want to return the information in an array, but simply want to
display the trace information you can use this function.  If we modify line 14
of the example above to say
<pre>
<?php
$script = <<<SCRIPT
 1 <?php
14     xdebug_dump_function_trace();
15 ?>
SCRIPT;
highlight_string($script);
?>
</pre>
the following table with information is shown:
<table border='1' cellspacing='0'>
<tr><th bgcolor='#aaaaaa' colspan='5'>Function trace</th></tr>
<tr><th bgcolor='#cccccc'>Time</th><th bgcolor='#cccccc'>#</th><th bgcolor='#cccccc'>Function</th><th bgcolor='#cccccc'>Location</th><th bgcolor='#cccccc'>Memory</th></tr>
<tr><td bgcolor='#ffffff' align='center'>0</td><td bgcolor='#ffffff' align='left'><pre>  -></pre></td><td bgcolor='#ffffff'>fix_string(array (0 =&gt; &#039;Derick&#039;))</td><td bgcolor='#ffffff'>/home/httpd/html/test/xdebug_caller.php<b>:</b>13</td><td bgcolor='#ffffff' align='right'>37352</td></tr>

<tr><td bgcolor='#ffffff' align='center'>0.000096</td><td bgcolor='#ffffff' align='left'><pre>    -></pre></td><td bgcolor='#ffffff'><a href='http://uk.php.net/xdebug_call_file' target='_new'>xdebug_call_file</a>
()</td><td bgcolor='#ffffff'>/home/httpd/html/test/xdebug_caller.php<b>:</b>6</td><td bgcolor='#ffffff' align='right'>37408</td></tr>
<tr><td bgcolor='#ffffff' align='center'>0.000117</td><td bgcolor='#ffffff' align='left'><pre>    -></pre></td><td bgcolor='#ffffff'><a href='http://uk.php.net/xdebug_call_line' target='_new'>xdebug_call_line</a>
()</td><td bgcolor='#ffffff'>/home/httpd/html/test/xdebug_caller.php<b>:</b>8</td><td bgcolor='#ffffff' align='right'>37464</td></tr>

<tr><td bgcolor='#ffffff' align='center'>0.000137</td><td bgcolor='#ffffff' align='left'><pre>    -></pre></td><td bgcolor='#ffffff'><a href='http://uk.php.net/xdebug_call_function' target='_new'>xdebug_call_function</a>
()</td><td bgcolor='#ffffff'>/home/httpd/html/test/xdebug_caller.php<b>:</b>10</td><td bgcolor='#ffffff' align='right'>37472</td></tr>
</table>
</dl>

<a name="xdebug_memory_usage"></a>
<dt>int xdebug_memory_usage()</dt>
<dd>Returns the current amount of memory the script uses. (Only works when PHP
was compiled with --enable-memory-limit).</dd>
</dl>

<a name="xdebug_peak_memory_usage"></a>
<dt>int xdebug_peak_memory_usage() (Xdebug 2)</dt>
<dd>Returns the maximum amount of memory the script used up til now. (Only
works when PHP was compiled with --enable-memory-limit).</dd>
</dl>

<a name="xdebug_time_index"></a>
<dt>float xdebug_time_index()</dt>
<dd>Returns the current time index since the starting of the script in
seconds.</dd>
</p>

<br />
<span class="sans">CODE COVERAGE RELATED</span><br />
<dl>
<a name='xdebug_start_code_coverage'></a>
<dt>void xdebug_start_code_coverage()</dt>
<dd>This function starts gathering the information for code coverage. The
information that is collected constists of an two dimensional array with as
primairy index the executed filename and as secondairy key the line number. The
value in the elements represents the total number of execution units on this
line have been executed.</dd>

<a name='xdebug_stop_code_coverage'></a>
<dt>void xdebug_stop_code_coverage()</dt>
<dd>This function stops collecting information, the information in memory will
not be destroyed so that you can resume the gathering of information with the
<i>xdebug_start_code_coverage()</i> function again.</dd>

<a name='xdebug_get_code_coverage'></a>
<dt>array xdebug_get_code_coverage()</dt>
<dd>Returns a structure which contains information about how many times an
execution units were executed on the specified line in your script (including
include files). The following example:
<pre class='example'><?php
$script = <<<SCRIPT
 1 <?php
 2     xdebug_start_code_coverage();
 3 
 4     function a(\$a) {
 5         echo \$a * 2.5;
 6     }
 7 
 8     function b(\$count) {
 9         for (\$i = 0; \$i < \$count; \$i++) {
10             a(\$i + 0.17);
11         }
12     }
13 
14     b(6);
15     b(10);
16 
17     var_dump(xdebug_get_code_coverage());
18 ?>  
SCRIPT;
highlight_string($script);
?>
</pre>
returns this array:
<pre class='example'>
array(1) {
  ["/home/httpd/html/test/xdebug_coverage.php"]=&gt;
  array(10) {
    [4]=&gt;
    int(1)
    [5]=&gt;
    int(16)
    [6]=&gt;
    int(16)
    [8]=&gt;
    int(1)
    [9]=&gt;
    int(20)
    [10]=&gt;
    int(16)
    [12]=&gt;
    int(2)
    [14]=&gt;
    int(1)
    [15]=&gt;
    int(1)
    [17]=&gt;
    int(1)
  }
}</pre>
</dd>
</dl>

<br />
<a name="profile"></a>
<a name='dump_function_profile'></a>
<span class="sans">PROFILING RELATED</span><br />
<dl>
<dt>void xdebug_start_profiling()<br />
void xdebug_stop_profiling()<br />
void xdebug_dump_function_profile([int profiling_mode])<br />
void xdebug_get_function_profile([int profiling_mode])</dt>
<dd>Please see the section on <a href='docs-profiling.php'>Profiling</a> for
information about these functions.</dl>
</dl>

<br />
<a name="superglobals"></a>
<span class="sans">INFORMATION DUMPING RELATED</span><br />
<dl>
<dt>void xdebug_dump_superglobals()</dt>
<dd>This function dumps the values of the elements of the superglobals as
specifed with the 'xdebug.dump.' php.ini settings as decribed in the section <a
href='docs-settings.php#superglobal'>settings</a>. An example output might look like (the
only ini setting that is made for this is 'xdebug.dump.SERVER = REMOTE_ADDR'):
<table border='1' cellspacing='0'>
<tr><th colspan='3' bgcolor='#aaaaaa'>Dump $_SERVER</th></tr>
<tr><td colspan='2' bgcolor='#ffffff'>$_SERVER['REMOTE_ADDR']</td><td bgcolor='#ffffff'>'127.0.0.1'</td></tr>
</table>

<a name="var_dump"></a>
<dt>void var_dump([mixed var])</dt>
<dd>This function displays structured information about one or more expressions
that includes its type and value. Arrays are explored recursively with values
<pre class='example'><?php
$script = <<<SCRIPT
 1 <?php
 2     var_dump(
 3         array(
 4             array(TRUE, FALSE, 3), 
 5             'twee' => array('4', NULL, '6')
 6         )
 7     );
 8 ?>  
SCRIPT;
highlight_string($script);
?>
</pre>
displays:
<br />
<br />
<img src='images/vardump.png' align='center' border='0'/>
</dd>

</dl>
</dl>

<br /><br />

<!-- MAIN FEATURE END -->

			</span></td>
			<td>&nbsp;</td>
			<td>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>
<?php include "include/side.php"; ?>
						</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
<?php include "include/footer.php"; ?>
