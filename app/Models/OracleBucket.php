<?php
namespace App\Models;

define('ORACLE_ACCESS_KEY', env('ORACLE_ACCESS_KEY'));
define('ORACLE_SECRET_KEY', env('ORACLE_SECRET_KEY'));
define('ORACLE_REGION', env('ORACLE_DEFAULT_REGION'));
define('ORACLE_NAMESPACE', env('ORACLE_NAMESPACE'));

class OracleBucket {
public function get_oracle_client($endpoint)
{
    $endpoint = "https://".ORACLE_NAMESPACE.".compat.objectstorage.".ORACLE_REGION.".oraclecloud.com/{$endpoint}";;
    return new \Aws\S3\S3Client(array(
        'credentials' => [
            'key' => ORACLE_ACCESS_KEY,
            'secret' => ORACLE_SECRET_KEY,
        ],
        'version' => 'latest',
        'region' => ORACLE_REGION,
        'bucket_endpoint' => true,
        'endpoint' => $endpoint
    ));
}

public function upload_file_oracle($bucket_name, $folder_name = '', $file_name)
{
    if (empty(trim($bucket_name))) {
        return array('success' => false, 'message' => 'Please provide valid bucket name!');
    }

    if (empty(trim($file_name))) {
        return array('success' => false, 'message' => 'Please provide valid file name!');
    }

    if ($folder_name !== '') {
        $keyname = $folder_name . '/' . $file_name;
        $endpoint =  "{$bucket_name}/";
    } else {
        $keyname = $file_name;
        $endpoint =  "{$bucket_name}/{$keyname}";
    }

    $s3 = $this->get_oracle_client($endpoint);
    $s3->getEndpoint();

    //https://objectstorage.ap-sydney-1.oraclecloud.com/p/TZ1m-IZuAvyjYrLPxX5em6cGOgoEtlHEEy2rwsH0olpAm2JiZzIKasERUOEy5y6c/n/sdesiggjgjjm/b/system_sales/o/
    $file_url = "https://objectstorage.".ORACLE_REGION.".oraclecloud.com/p/TZ1m-IZuAvyjYrLPxX5em6cGOgoEtlHEEy2rwsH0olpAm2JiZzIKasERUOEy5y6c/n/".ORACLE_NAMESPACE."/b/{$bucket_name}/o/{$keyname}";
    try {
        $s3->putObject(array(
            'Bucket' => $bucket_name,
            'Key' => $keyname,
            'SourceFile' => $file_name,
            'StorageClass' => 'REDUCED_REDUNDANCY'
        ));

        return $file_url;
    } catch (S3Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
    } catch (Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
    }
}

public function delete_file_oracle($folder_name, $file_name)
{
    $bucket_name = 'system_sales';
    if ($folder_name !== '') {
        $keyname = $folder_name . '/' . $file_name;
        $endpoint =  "{$bucket_name}/";
    } else {
        $keyname = $file_name;
        $endpoint =  "{$bucket_name}/{$keyname}";
    }
    $s3 = $this->get_oracle_client($endpoint);
    $s3->getEndpoint();

    try
    {
        $s3->deleteObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $keyname
        ));
    }
    catch (S3Exception $e) {
        exit('Error: ' . $e->getAwsErrorMessage() . PHP_EOL);
    }
}
}
?>
