@switch($user->type)
    @case(\App\Models\User::SUPERVISOR_TYPE)
    <svg height="10pt"
         viewBox="0 0 512 512"
         width="10pt"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0"
            fill="#28a745"/>
        <path
            d="m385.75 201.75-138.667969 138.664062c-4.160156 4.160157-9.621093 6.253907-15.082031 6.253907s-10.921875-2.09375-15.082031-6.253907l-69.332031-69.332031c-8.34375-8.339843-8.34375-21.824219 0-30.164062 8.339843-8.34375 21.820312-8.34375 30.164062 0l54.25 54.25 123.585938-123.582031c8.339843-8.34375 21.820312-8.34375 30.164062 0 8.339844 8.339843 8.339844 21.820312 0 30.164062zm0 0"
            fill="#fafafa"/>
    </svg>
    @break
    @case(\App\Models\User::ADMIN_TYPE)
    <svg height="10pt"
         viewBox="0 0 512 512"
         width="10pt"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0"
            fill="#605ca8"/>
        <path
            d="m385.75 201.75-138.667969 138.664062c-4.160156 4.160157-9.621093 6.253907-15.082031 6.253907s-10.921875-2.09375-15.082031-6.253907l-69.332031-69.332031c-8.34375-8.339843-8.34375-21.824219 0-30.164062 8.339843-8.34375 21.820312-8.34375 30.164062 0l54.25 54.25 123.585938-123.582031c8.339843-8.34375 21.820312-8.34375 30.164062 0 8.339844 8.339843 8.339844 21.820312 0 30.164062zm0 0"
            fill="#fafafa"/>
    </svg>
    @break
@endswitch
