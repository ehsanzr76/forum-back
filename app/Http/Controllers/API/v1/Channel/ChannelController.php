<?php

namespace App\Http\Controllers\API\v1\Channel;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Channel\CreateChannelRequest;
use App\Http\Requests\API\v1\Channel\DeleteChannelRequest;
use App\Http\Requests\API\v1\Channel\UpdateChannelRequest;
use App\Repositories\ChannelRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ChannelController extends Controller
{

    /**
     * @var ChannelRepository
     */
    private ChannelRepository $channelRepo;

    /**
     * ChannelController constructor.
     * @param ChannelRepository $repo
     */
    public function __construct(ChannelRepository $repo)
    {
        $this->channelRepo = $repo;
    }



//GetAllChannel

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->channelRepo->index();
        return response()->json($this->channelRepo, Response::HTTP_OK);
    }



//CreateChannel

    /**
     * @param CreateChannelRequest $request
     * @return JsonResponse
     */
    public function create(CreateChannelRequest $request): JsonResponse
    {
        $request->safe()->all();
        $this->channelRepo->create($request->name);

        return response()->json([
            'message' => 'channel created successfully'
        ], Response::HTTP_CREATED);


    }



//UpdateChannel

    /**
     * @param UpdateChannelRequest $request
     * @return JsonResponse
     */
    public function update(UpdateChannelRequest $request): JsonResponse
    {
        $request->safe()->all();
        $this->channelRepo->update($request->id, $request->name);

        return response()->json([
            'message' => 'channel updated successfully'
        ], Response::HTTP_OK);
    }



//DeleteChannel

    /**
     * @param DeleteChannelRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteChannelRequest $request): JsonResponse
    {
        $request->safe()->all();

        $this->channelRepo->destroy($request->id);
        return response()->json([
            'message' => 'channel deleted successfully'
        ], Response::HTTP_OK);
    }


}
