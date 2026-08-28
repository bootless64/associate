<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function manageTickets(Request $request)
    {
        $query = Ticket::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('sender_name')) {
            $query->whereHas('sender', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->sender_name.'%');
            });
        }
        if ($request->filled('receiver_name')) {
            $query->whereHas('receiver', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->receiver_name.'%');
            });
        }
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%'.$request->subject.'%');
        }
        if ($request->filled('message')) {
            $query->where('message', 'like', '%'.$request->message.'%');
        }
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tickets = $query->withTrashed()->orderBy('created_at','desc')->paginate(25)
                          ->appends($request->only(['id','sender_name','subject','message','project_id','status']));

        return view('dashboard.manage-tickets', compact('tickets'));
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'in:open,in_progress,closed',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $validated['status'];
        $ticket->save();

        return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
    }

    public function updateResponse(Request $request, $id)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:500',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->response = $validated['response'];
        $ticket->save();

        return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
    }


    public function destroy($id)
    {
        Ticket::destroy($id);
        return back()->with('success', 'تیکت حذف شد.');
    }




    public function manageSupportTickets(Request $request)
    {
        $query = Ticket::query()->where('project_id', null);

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('sender_name')) {
            $query->whereHas('sender', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->sender_name.'%');
            });
        }
        if ($request->filled('receiver_name')) {
            $query->whereHas('receiver', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->receiver_name.'%');
            });
        }
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%'.$request->subject.'%');
        }
        if ($request->filled('message')) {
            $query->where('message', 'like', '%'.$request->message.'%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tickets = $query->orderBy('created_at','desc')->paginate(25)
                          ->appends($request->only(['id','user_name','subject','message','status']));

        return view('dashboard.manage-support-tickets', compact('tickets'));
    }


    public function storeSupportTicket(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|integer|exists:users,id',
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:500',
        ]);

        $ticket = new Ticket();

        $ticket->sender_id = auth()->id();
        $ticket->receiver_id = $validated['receiver_id'];
        $ticket->subject = $validated['subject'];
        $ticket->message = $validated['message'];
        $ticket->status = 'open';

        $ticket->save();

        return back()->with('success', 'تیکت شما به کاربر مورد نظر ارسال شد.');
    }


    public function updateSupportTicketStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'in:open,in_progress,closed',
        ]);

        $ticket = Ticket::where('project_id', null)->findOrFail($id);
        $ticket->status = $validated['status'];
        $ticket->save();

        return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
    }

    public function updateSupportTicketResponse(Request $request, $id)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:500',
        ]);

        $ticket = Ticket::where('project_id', null)->findOrFail($id);

        if($ticket->receiver_id) {
            return abort(403);
        }

        $ticket->response = $validated['response'];
        $ticket->save();
        return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
    }


    public function destroySupportTicket($id)
    {
        $ticket = Ticket::where('project_id', null)->findOrFail($id);
        $ticket->delete();

        return back()->with('success', 'تیکت حذف شد.');
    }




    public function storeProjectTicket(Request $request, $project_id)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:500',
        ]);

        $ticket = new Ticket();

        $ticket->sender_id = auth()->id();
        $ticket->project_id = $project_id;
        $ticket->subject = $validated['subject'];
        $ticket->message = $validated['message'];
        $ticket->status = 'open';

        $ticket->save();

        return back()->with('success', 'تیکت شما ثبت شد و بررسی خواهد شد. برای پیگیری وضعیت تیکت می‌توانید به همین صفحه مراجعه کنید.');
    }


    public function updateProjectTicketStatus(Request $request, $project_id, $ticket_id)
    {
        $validated = $request->validate([
            'status' => 'in:open,in_progress,closed',
        ]);

        $ticket = Ticket::findOrFail($ticket_id);

        if (auth()->id() === $ticket->project->primary_coach_id || auth()->id() === $ticket->project->secondary_coach_id)
        {
            $ticket->status = $validated['status'];
            $ticket->save();
            return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
        }
        return abort(403);
    }

    public function updateProjectTicketResponse(Request $request, $project_id, $ticket_id)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:500',
        ]);

        $ticket = Ticket::findOrFail($ticket_id);

        if (auth()->id() === $ticket->sender_id) {
            return abort(403);
        }

        $ticket->response = $validated['response'];
        $ticket->save();
        return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
    }


    public function destroyProjectTicket($project_id, $ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        if (auth()->id() === $ticket->project->primary_coach_id || auth()->id() === $ticket->project->secondary_coach_id)

        $ticket->delete();

        return back()->with('success', 'تیکت حذف شد.');
    }




    public function myTickets()
    {
        /** @var User $user*/
        $user = auth()->user();

        $my_tickets = Ticket::where(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->where('project_id', null)->latest()->paginate(25);

        return view('dashboard.my-tickets', compact('my_tickets'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:500',
        ]);

        $ticket = new Ticket();

        $ticket->sender_id = auth()->id();
        $ticket->subject = $validated['subject'];
        $ticket->message = $validated['message'];
        $ticket->status = 'open';

        $ticket->save();
        return back()->with('success', 'تیکت شما ثبت شد و بررسی خواهد شد. برای پیگیری وضعیت تیکت می‌توانید به همین صفحه مراجعه کنید.');
    }


    public function updateMyTicketResponse(Request $request, $id)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:500',
        ]);

        $ticket = Ticket::where('project_id', null)->findOrFail($id);

        if(auth()->id() === $ticket->sender_id) {
            return abort(403);
        }

        $ticket->response = $validated['response'];
        $ticket->save();
        return back()->with('success', 'وضعیت تیکت به‌روزرسانی شد.');
    }
}
